<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function collected_by() {
        return $this->morphedByMany(User::class, 'collection');
    }

    public function favorited_by() {
        return $this->morphedByMany(User::class, 'favorite');
    }
}
