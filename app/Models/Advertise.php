<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location_id',
        'image',
        'video',
        'link'
    ];

    /**
     * Get the location that owns the advertisement.
     */
    public function location()
    {
        return $this->belongsTo(AdvertiseLocation::class, 'location_id');
    }
}

