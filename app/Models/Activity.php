<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'value',
        'value_unity',
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
