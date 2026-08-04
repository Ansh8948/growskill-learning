<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
            $query = Course::with('category')->where('is_active', true);
        $categories = Category::withCount('courses')->get();
        $featuredCourses = Course::with('category')->where('is_featured', true)->latest()->take(8)->get();
        $latestCourses = Course::with('category')->latest()->take(8)->get();

        return view('home', compact('categories', 'featuredCourses', 'latestCourses'));
    }
    public function about()
{
    $categories = Category::withCount('courses')->get();
    $stats = [
        'courses' => Course::count(),
        'categories' => Category::count(),
        'students' => \App\Models\User::count(),
    ];

    return view('about', compact('categories', 'stats'));
}
}
