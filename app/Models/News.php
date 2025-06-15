<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = [
    'title',
    'slug',
    'category_id',
    'subcategory_id',
    'description',
    'slug',
];
}
