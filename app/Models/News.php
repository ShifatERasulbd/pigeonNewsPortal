<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $fillable = [
    'title',
    'author_name',
    'video',
    'image',
    'slug',
    'category_id',
    'subcategory_id',
    'description',
    'TopLead',
    'lead_news',
    'meta_keywords',
    'location',
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

     public function location()
    {
        return $this->belongsTo(Location::class, 'location');
    }
}
