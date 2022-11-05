<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::get();
//        return ImageResource::collection($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $image = new Image();
            $filename = date('YmdHi').$imageFile->getClientOriginalName();
            $image->path = $filename;
            $imageFile->move(public_path().'/images/', $filename);
            if ($image->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Image saved successfully with id ' . $image->id,
                    'image_id' => $image->id
                ], Response::HTTP_CREATED);
            }
            return response()->json([
                'success' => false,
                'message' => 'Image saved failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function storeMany(Request $request)
    {
        $images = array();
        if ($request->hasFile('images')) {
            $imagesFile = $request->file('images');
            foreach ($imagesFile as $imageFile) {
                $image = new Image();
                $filename = date('YmdHi').$imageFile->getClientOriginalName();
                $image->path = $filename;
                $imageFile->move(public_path().'/images/', $filename);
                if (!$image->save()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Images saved failed'
                    ], Response::HTTP_BAD_REQUEST);
                }
                array_push($images, $image->id);
            }
            return response()->json([
                'success' => true,
                'message' => 'Images saved successfully', 
                'data' => json_encode($images)
            ], Response::HTTP_CREATED);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    public function getProfileImageByEmail($email) {
        $user = User::all()->where('email', $email)->first();
        if($user == null) 
            return response()->json([
                'message' => 'Can\'t find profile picture by '.$email], 
                Response::HTTP_NOT_FOUND
            );

        return response()->json($user->image->path, Response::HTTP_OK);
    }
}
