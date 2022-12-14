<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
    public function show(Request $request, $tag)
    {
        $quantity = $request->query('quantity');
        $tag = Tag::where('name', $tag)->first();
        if($tag == null)
            return response()->json(['success' => false, 'message' => 'Can\'t find tag on null'], Response::HTTP_NOT_FOUND);
        if($tag->posts->count() == 0)
            return response()->json(['success' => false, 'data' => [], 'message' => 'No posts'], Response::HTTP_NOT_FOUND);

        if($quantity == 0)
            return  PostResource::collection($tag->posts->toQuery()->paginate(15));
        else 
            return  PostResource::collection($tag->posts->toQuery()->inRandomOrder()->limit($quantity)->get());
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
