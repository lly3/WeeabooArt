<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'resetPasswordRequest', 'resetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validator->fails()) {
//            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
            return response()->json(['error' => 'The email address or password is incorrect.'], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'The email address or password is incorrect.'], Response::HTTP_UNAUTHORIZED); // 401
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function me()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'date_of_birth' => ['required', 'date'],
            'image_id' => ['integer', 'required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->image_id = $request->get('image_id');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], Response::HTTP_CREATED); // 201
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            //    'user' => new UserResource(auth()->user())
        ]);
    }

    public function resetPasswordRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND); // 404
        } else {
            $user->reset_password_token = rand(100000, 999999);
            if($user->save()) {

                try {
                    Mail::send('emails.reset_password', ['user' => $user], function ($m) use ($user) {
                        $m->from('no-reply@weeaboo.art', 'WeeabooArt')->to($user->email, $user->name)->subject('Reset Password (WeeabooArt)');
                    });
                    return response()->json(['message' => 'Email sent successfully'], Response::HTTP_OK); // 200
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Error sending email'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
                }


                //check mail is sent or not


//                if(count(Mail::failures()) > 0) {
//                    return response()->json(['error' => 'Failed to send email'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
//                } else {
//                    return response()->json(['message' => 'Email sent successfully'], Response::HTTP_OK); // 200
//                }

//                if(Mail::failures()) {
//                    return response()->json(['error' => 'Email not sent'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
//                } else {
//                    return response()->json(['message' => 'Email sent'], Response::HTTP_OK); // 200
//                }

            }   else {
                return response()->json(['error' => 'Email not sent'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
            }


//            $user->sendPasswordResetNotification($user->reset_password_token);
//            return response()->json(['message' => 'Reset password link sent to your email']);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'string'],
            'reset_password_token' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = User::where('email', $request->get('email'))->where('reset_password_token', $request->reset_password_token)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found/Invalid token'], Response::HTTP_NOT_FOUND); // 404
        } else {
            $user->password = bcrypt($request->get('password'));
            $user->reset_password_token = null;
            if($user->save()) {
                return response()->json(['message' => 'Password changed'], Response::HTTP_OK); // 200
            } else {
                return response()->json(['error' => 'Password not changed'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
            }
        }
    }

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = auth()->user();
        if ($request->get('name')) {
            $user->name = $request->get('name');
        }
        if ($request->get('email')) {
            $user->email = $request->get('email');
        }

        if ($user->save()) {
            return response()->json(['message' => 'Profile updated'], Response::HTTP_OK); // 200
        } else {
            return response()->json(['error' => 'Profile not updated'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }

    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
           'current_password' => ['required', 'string'],
           'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = auth()->user();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = bcrypt($request->get('password'));
            if ($user->save()) {
                return response()->json(['message' => 'Password updated'], Response::HTTP_OK); // 200
            } else {
                return response()->json(['error' => 'Password not updated'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
            }
        } else {
            return response()->json(['error' => 'Current password is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }
    }

    public function updateProfilePicture(Request $request) {
        $validator = Validator::make($request->all(), [
            'image_id' => ['integer', 'required'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $user = auth()->user();
        $user->image_id = $request->get('image_id');

        if ($user->save()) {
            return response()->json(['message' => 'Profile picture updated'], Response::HTTP_OK); // 200
        } else {
            return response()->json(['error' => 'Profile picture not updated'], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        }
    }
}
