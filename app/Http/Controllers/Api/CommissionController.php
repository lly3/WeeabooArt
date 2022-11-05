<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'more_by']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::orderBy('id', 'desc')->paginate(15);
        return CommissionResource::collection($commissions);
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
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'imagesID' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY); // 422
        }

        $commission = new Commission();
        $commission->title = $request->get('title');
        $commission->description = $request->get('description') ?? "ไม่ระบุรายละเอียดเพิ่มเติม";
        $commission->price = $request->get('price');
        $commission->user_id = auth()->user()->id;

        if (! $commission->save()) {
            return response()->json([
                'success' => false,
                'message' => 'Commission saved failed'
            ], Response::HTTP_BAD_REQUEST);
        }

        $imagesID = json_decode($request->get('imagesID'));
        foreach (Image::find($imagesID)->all() as $image) {
           $commission->images()->save($image); 
        }

        return response()->json([
            'success' => true,
            'message' => 'Commission saved successfully with id ' . $commission->id,
            'commission_id' => $commission->id
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission) 
    {
        $commission->view_count++;
        $commission->save();
        return new CommissionResource($commission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        return new CommissionResource($commission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        if ($request->has('title')) $commission->title = $request->get('title');
        if ($request->has('description')) $commission->description = $request->get('description');
        if ($request->has('price')) $commission->price = $request->get('price');

        if (! $commission->save()) {
            return response()->json([
                'success' => false,
                'message' => 'Commission update failed'
            ], Response::HTTP_BAD_REQUEST);
        }

        if($request->has('imagesID')) {
            $this->deleteOldImages($commission);

            $imagesID = json_decode($request->get('imagesID'));
            foreach (Image::find($imagesID)->all() as $image) {
                $commission->images()->save($image); 
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Commission update successfully with id ' . $commission->id,
            'commission_id' => $commission->id
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commission $commission)
    {
        $commission_title = $commission->title;
        $this->deleteOldImages($commission);
        if ($commission->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Commission {$commission_title} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Commission {$commission_title} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }

    private function deleteOldImages($commission) {
        // delete old images
        foreach($commission->images as $image) {
            File::delete(public_path().'/images/'.$image->path);
            $image->delete();
        }
    }

    public function more_by(Request $request, $user_id) {
        if($request->query('quantity') != null) {
            if($request->query('random') == 'false') {
                $posts = Commission::where('user_id', $user_id)
                    ->limit($request->query('quantity'))
                    ->get();
                return CommissionResource::collection($posts);
            }
            $posts = Commission::where('user_id', $user_id)
                ->inRandomOrder()
                ->limit($request->query('quantity'))
                ->get();
            return CommissionResource::collection($posts);
        }
        else {
            $posts = Commission::where('user_id', $user_id)
                ->get();
            return CommissionResource::collection($posts);
        }
        return response()->json([
            'message' => 'fetch more post by user_id' . $user_id . 'failed',
            'success' => false
        ], Response::HTTP_BAD_REQUEST);
    }

}
