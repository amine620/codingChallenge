<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'price',];


    function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
