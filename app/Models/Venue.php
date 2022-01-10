<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'city_id', 'category_id', 'title', 'address', 'phone', 'email', 'website', 'facebook', 'instagram', 'content', 'cover_image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'venue_feature');
    }

    public function images()
    {
        return $this->hasMany(VenueImage::class);
    }
}
