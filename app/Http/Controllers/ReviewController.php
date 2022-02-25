<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Services\ImageService;
use App\Models\Review;
use App\Models\ReviewImage;

class ReviewController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $addData = ['user_id' => auth()->id()];


        $review = Review::Create($request->validated() + $addData);

        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                $imagePath = ImageService::upload($file);
                $image = new ReviewImage();
                $image->path = $imagePath;
                $image->review_id = $review->id;
                $review->images()->save($image);
            }
        }

        return response()->json([
            'result' => 'true'
        ]);
    }
}
