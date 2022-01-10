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
use App\Services\ImageServices;

class VenueController extends Controller
{
    public function create()
    {
        $booleanFeatures = Feature::where('type', '=', 'bool')->get();
        $textFeatures = Feature::where('type', '=', 'text')->get();
        $categories = Category::all();
        $cities = City::all();

        return view('frontend.venues.create', [
            'booleanFeatures' => $booleanFeatures,
            'textFeatures' => $textFeatures,
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function store(StoreVenueRequest $request)
    {
        if ($request->file('coverImage')) {
            $imagePath = (new ImageService())->upload($request->file('coverImage'));
            $addData['cover_image'] = $imagePath;
        }

        $addData = ['user_id' => auth()->id()];

        $venue = Venue::create($request->validated() + $addData);
        $venue->features()->attach($request->all()['features_bool']);

        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                $imagePath = (new ImageService())->upload($file);
                $image = new VenueImage();
                $image->path = $imagePath;
                $venue->images()->save($image);
            }
        }
    }

    public function show(Venue $venue)
    {
        return view('frontend.venues.show', [
            'venue' => $venue
        ]);
    }
}
