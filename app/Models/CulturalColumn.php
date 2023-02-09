<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CulturalColumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_url',
        'content'
    ];

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function truncatedContent() {
        return Str::limit($this->content, 7);
    }
}
