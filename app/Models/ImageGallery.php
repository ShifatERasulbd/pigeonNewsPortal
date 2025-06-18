<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'categoryId', // Match the column name in your database
    ];

    /**
     * Get the category that owns the gallery.
     */
    public function category()
    {
        return $this->belongsTo(ImageCategory::class, 'categoryId');
    }

    /**
     * Get the images for the gallery.
     */
    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_id');
    }
}


