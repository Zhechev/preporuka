<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\Category;
use App\Models\City;
use App\Models\Venue;
use App\Models\VenueImage;
use App\Services\ImageService;

class VenueController extends Controller
{
    public function create(Category $category)
    {
        $categories = Category::all();
        $cities = City::all();
        $features = $category->features;

        return view('frontend.venues.create', [
            'category' => $category,
            'categories' => $categories,
            'cities' => $cities,
            'features' => $features
        ]);
    }

    public function store(StoreVenueRequest $request)
    {
        $addData = ['user_id' => auth()->id()];

        if ($request->file('coverImage')) {
            $imagePath = ImageService::upload($request->file('coverImage'));
            $addData['cover_image'] = $imagePath;
        }

        $venue = Venue::create($request->validated() + $addData);
        $venue->features()->attach($request->all()['features_bool']);

        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                $imagePath = ImageService::upload($file);
                $image = new VenueImage();
                $image->path = $imagePath;
                $venue->images()->save($image);
            }
        }

        return redirect()->route('venues.show', [
            'venue' => $venue
        ]);
    }

    public function show(Venue $venue)
    {
        $categories = Category::all();

        return view('frontend.venues.show', [
            'venue' => $venue,
            'categories' => $categories
        ]);
    }
}
