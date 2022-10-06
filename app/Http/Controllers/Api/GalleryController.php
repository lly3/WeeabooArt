<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;

class GalleryController extends Controller
{
    public function index() {
        $top_image_likes_count = Image::orderBy('likes_count', 'desc')->get(6);
        $top_image_views_count = Image::orderBy('views_count', 'desc')->get(6);
        return ImageResource::collection([$top_image_likes_count, $top_image_views_count]);
    }
}
