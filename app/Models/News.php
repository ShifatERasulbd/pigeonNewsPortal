<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = [
    'title',
    'video',
    'image',
    'slug',
    'category_id',
    'subcategory_id',
    'description',
    'TopLead',
    'lead_news',
    'meta_keywords',
    'slug',
];
  public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
