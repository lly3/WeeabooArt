<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::get();
        return ImageResource::collection($images);
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
        $image = new Image();
        $image->image_path = $request->get('image_path');
        $image->date = $request->get('date');
        $image->post_id = $request->get('post_id');
        $image->commission_id = $request->get('commission_id');
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
        if ($image->has('title')) $image->image_path = $request->get('image_path');
        if ($image->has('date')) $image->date = $request->get('date');
        if ($image->has('post_id')) $image->post_id = $request->get('post_id');
        if ($image->has('commission_id')) $image->commission_id = $request->get('commission_id');
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
}
