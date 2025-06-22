<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGalleryCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the video galleries for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoGalleries()
    {
        return $this->hasMany(VideoGallery::class, 'category_id');
    }
}

