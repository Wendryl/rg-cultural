<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'value',
        'value_unity',
        'art_picture_url',
        'experience',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'type',
        'approved'
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
