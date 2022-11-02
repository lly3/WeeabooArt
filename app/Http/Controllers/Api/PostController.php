<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
//use Intervention\Image\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);
        return PostResource::collection($posts);
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
        $post = new Post();
        $post->title = $request->get('title');
        $post->description = $request->get('description') ?? "ไม่ระบุรายละเอียดเพิ่มเติม";
        $post->is_saleable = $request->get('premium_download');
        $post->price = $request->get('price');
        $post->image_id = $request->get('imageID');
        if($post->is_saleable) {
            $this->addWatermask($post);
        }
        $post->user_id = auth()->user()->id;
        if ($post->save()) {
            $tags = $request->get('tags');
            $tag_ids = $this->syncTags($tags);
            $post->tags()->sync($tag_ids);
            return response()->json([
                'success' => true,
                'message' => 'Post saved successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->view_count++;
        $post->save();
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $post->user;
        $post->image;
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        if ($request->has('title')) $post->title = $request->get('title');
        if ($request->has('description')) $post->description = $request->get('description');
        if ($request->has('is_saleable')) $post->is_saleable = $request->get('is_saleable');
        if ($request->has('price')) $post->price = $request->get('price');
        if ($request->has('favorite_count')) $post->favorite_count = $request->get('favorite_count');
        if ($request->has('view_count')) $post->view_count = $request->get('view_count');
        if($request->has('imageID')) {
            File::delete('images/'.$post->image->path);
            $post->image_id = $request->get('imageID');
        }

        if ($post->save()) {
            $tags = $request->get('tags');
            $tag_ids = $this->syncTags($tags);
            $post->tags()->sync($tag_ids);
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post updated failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post_title = $post->title;
        if ($post->delete() && $post->user_id == auth()->user()->id) {
            File::delete('images/'.$post->image->path);
            return response()->json([
                'success' => true,
                'message' => "Post {$post_title} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Post {$post_title} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }

    public function mostLiked() {
        $posts = Post::orderBy('favorite_count', 'desc')->take(6)->get();
        foreach ($posts as $post) {
            $post->image;
            $post->user_name = $post->user->name;
        }
        return response()->json($posts->toArray());
    }

    public function mostViewed() {
        $posts = Post::orderBy('view_count', 'desc')->take(6)->get();
        foreach ($posts as $post) {
            $post->image;
            $post->user_name = $post->user->name;
        }
        return response()->json($posts->toArray());
    }

    public function otherPosts() {
        return Post::orderBy('id', 'desc')->paginate(15);
    }

    public function buyArtPost(Post $post) {
        $user = User::find(auth()->user()->id);
        if (! $post->collected_by->find($user->id)) {
            if($post->collected_by()->save($user, ['user_id' => $user->id])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Make transaction successfully'
                ], Response::HTTP_OK);
            }
            return response()->json([
                'success' => false,
                'message' => 'Make transaction failed'
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'success' => false,
            'message' => 'You already owned this art'
        ], Response::HTTP_BAD_REQUEST);
    }

    public function isCollected(Post $post) {
        $user = User::find(auth()->user()->id);
        if ($post->collected_by->find($user->id) != null) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function isFavorited(Post $post) {
        $user = User::find(auth()->user()->id);
        if ($post->favorited_by->find($user->id) != null) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function premiumDownload(Post $post) {
        if($post->is_saleable) {
            return response()->download(storage_path('images/'.$post->image->path));
        }
        return response()->json([
            'success' => false,
            'message' => 'This post is not support premium download'
        ], Response::HTTP_BAD_REQUEST);
    }

    private function syncTags($tags)
    {
        $tags = explode(',', $tags);
        $tags = array_map(function ($v) {
            return Str::ucfirst(trim($v));
        }, $tags);

        $tag_ids = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::where('name', $tag_name)->first();
            if (!$tag) {
                $tag = new Tag();
                $tag->name = $tag_name;
                $tag->save();
            }
            $tag_ids[] = $tag->id;
        }
        return $tag_ids;
    }

    private function addWatermask($post) {
        $img = Image::make(public_path('images/'.$post->image->path));
        File::move(public_path('images/'.$post->image->path), storage_path('images/'.$post->image->path));
        $img->insert(public_path('watermask.png'), 'center', 100, 100);
        $img->save(public_path('images/'.$post->image->path));
    }

    public function search(Request $request) {
        $search = $request->get('search');
        $posts = Post::where('title', 'LIKE', "%{$search}%")->get();
        foreach ($posts as $post) {
            $post->image;
        }
        return PostResource::collection($posts);

    }
}
