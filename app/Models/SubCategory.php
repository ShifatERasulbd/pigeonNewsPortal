<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    //
    protected $fillable = ['SubCategoryName', 'categoryId', 'slug'];
    public function category()
{
    return $this->belongsTo(Category::class, 'categoryId');
}
}
