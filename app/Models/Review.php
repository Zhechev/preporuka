<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'content', 'venue_id', 'user_id'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }
}
