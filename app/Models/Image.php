<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function commission() {
        return $this->belongsTo(Commission::class);
    }

    public function get6MostLiked() {
        return Image::orderBy('like_count', 'desc')->take(6)->get();
    }

    public function get6MostRecent() {
        return Image::orderBy('created_at', 'desc')->take(6)->get();
    }

    public function get6MostViewed() {
        return Image::orderBy('view_count', 'desc')->take(6)->get();
    }
}
