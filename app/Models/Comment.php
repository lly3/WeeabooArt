<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commission() {
        return $this->belongsTo(Commission::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
