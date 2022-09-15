<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointHistory extends Model
{
    use HasFactory, SoftDeletes;

    public function user() {
        $this->belongsTo(User::class);
    }

    public function scopeEarn($query) {
        return $query->where('action', 'earn');
    }

    public function scopeSpend($query) {
        return $query->where('action', 'spend');
    }
}
