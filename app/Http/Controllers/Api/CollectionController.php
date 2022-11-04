<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Collection;
use App\Models\Post;
use App\Models\User;

class CollectionController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function myCollection() {
        $user = User::find(auth()->user()->id);
        $collections = Collection::where('user_id', $user->id)->get();
        // join by post id
        $posts = Post::whereIn('id', $collections->pluck('post_id'))->get();
        return PostResource::collection($posts);
    }
}
