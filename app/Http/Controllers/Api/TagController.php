<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        return TagResource::collection($tags);
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
        $tag = new Tag();
        $tag->name = $request->get('name');
        if ($tag->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Tag saved successfully with id ' . $tag->id,
                'tag_id' => $tag->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Tag saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $tags = Tag::find($tag->name);
        return $tags;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        if ($tag->has('name')) $tag->name = $request->get('name');
        if ($tag->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Tag saved successfully with id ' . $tag->id,
                'tag_id' => $tag->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Tag saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
