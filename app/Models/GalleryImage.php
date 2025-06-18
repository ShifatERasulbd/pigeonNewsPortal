<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gallery_id',
        'image_path'
    ];

    /**
     * Get the gallery that owns the image.
     */
    public function gallery()
    {
        return $this->belongsTo(ImageGallery::class, 'gallery_id');
    }
}

