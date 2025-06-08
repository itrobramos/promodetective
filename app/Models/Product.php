<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','active', 'image_url', 'description'];

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'product_user_likes')
                    ->withTimestamps();
    }

    public function isLikedByUser($userId)
    {
        return $this->likedByUsers()->where('user_id', $userId)->exists();
    }
}
