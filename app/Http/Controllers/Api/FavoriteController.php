<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\User;

class FavoriteController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function myFavorite() {
        $user = User::find(auth()->user()->id);
        $favorites = Favorite::where('user_id', $user->id)->get();
        // join by post id
        $posts = Post::whereIn('id', $favorites->pluck('post_id'))->get();
        return PostResource::collection($posts);
    }
}
