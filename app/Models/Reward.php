<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory, SoftDeletes;

    public function rewardCodes() {
        return $this->hasMany(RewardCode::class);
    }

    public function scopeActive($query) {
        return $query->where('is_active', true);
    }

    public function scopeNotActive($query) {
        return $query->where('is_active', false);
    }
}
