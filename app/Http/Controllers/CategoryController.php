<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(category $category)
    {
        $categories = Category::all();

        return view('frontend.categories.show', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('frontend.categories.create');
    }
}
