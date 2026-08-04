<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $courses = $category->courses()->latest()->paginate(9);

        return view('categories.show', compact('category', 'courses'));
    }
}
