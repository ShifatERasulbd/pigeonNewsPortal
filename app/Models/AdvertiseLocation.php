<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiseLocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
    ];

    /**
     * Get the advertisements for this location.
     */
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'location_id');
    }
}

