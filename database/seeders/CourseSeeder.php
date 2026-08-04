<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Web Development' => [
                ['title' => 'Laravel 11 From Scratch', 'price' => 49.99, 'discount' => 29.99, 'level' => 'beginner', 'hours' => 22, 'featured' => true, 'instructor' => 'Ahmed Raza'],
                ['title' => 'Advanced React & Next.js', 'price' => 59.99, 'discount' => null, 'level' => 'advanced', 'hours' => 30, 'featured' => true, 'instructor' => 'Sarah Kim'],
                ['title' => 'Modern CSS & Tailwind Mastery', 'price' => 24.99, 'discount' => 14.99, 'level' => 'beginner', 'hours' => 12, 'featured' => false, 'instructor' => 'Devon Park'],
                ['title' => 'REST API Design with Laravel', 'price' => 39.99, 'discount' => null, 'level' => 'intermediate', 'hours' => 16, 'featured' => false, 'instructor' => 'Ahmed Raza'],
            ],
            'Data Science' => [
                ['title' => 'Python for Data Analysis', 'price' => 44.99, 'discount' => 27.99, 'level' => 'beginner', 'hours' => 20, 'featured' => true, 'instructor' => 'Priya Nair'],
                ['title' => 'Machine Learning A-Z', 'price' => 69.99, 'discount' => 44.99, 'level' => 'advanced', 'hours' => 35, 'featured' => true, 'instructor' => 'Daniel Osei'],
                ['title' => 'SQL for Data Professionals', 'price' => 19.99, 'discount' => null, 'level' => 'beginner', 'hours' => 10, 'featured' => false, 'instructor' => 'Priya Nair'],
            ],
            'UI/UX Design' => [
                ['title' => 'Figma UI Design Bootcamp', 'price' => 34.99, 'discount' => 19.99, 'level' => 'beginner', 'hours' => 15, 'featured' => true, 'instructor' => 'Lena Fischer'],
                ['title' => 'Design Systems at Scale', 'price' => 49.99, 'discount' => null, 'level' => 'advanced', 'hours' => 18, 'featured' => false, 'instructor' => 'Lena Fischer'],
                ['title' => 'User Research Fundamentals', 'price' => 22.99, 'discount' => null, 'level' => 'beginner', 'hours' => 9, 'featured' => false, 'instructor' => 'Marco Silva'],
            ],
            'Mobile Development' => [
                ['title' => 'Flutter & Dart Complete Guide', 'price' => 54.99, 'discount' => 34.99, 'level' => 'intermediate', 'hours' => 26, 'featured' => true, 'instructor' => 'Wei Zhang'],
                ['title' => 'iOS Development with SwiftUI', 'price' => 49.99, 'discount' => null, 'level' => 'intermediate', 'hours' => 24, 'featured' => false, 'instructor' => 'Olivia Brown'],
            ],
            'Business & Marketing' => [
                ['title' => 'SEO & Content Strategy 2026', 'price' => 29.99, 'discount' => 17.99, 'level' => 'beginner', 'hours' => 11, 'featured' => true, 'instructor' => 'James Carter'],
                ['title' => 'Startup Growth Playbook', 'price' => 39.99, 'discount' => null, 'level' => 'intermediate', 'hours' => 14, 'featured' => false, 'instructor' => 'James Carter'],
            ],
            'Cloud & DevOps' => [
                ['title' => 'AWS Certified Solutions Architect', 'price' => 64.99, 'discount' => 39.99, 'level' => 'advanced', 'hours' => 28, 'featured' => true, 'instructor' => 'Grace Muthoni'],
                ['title' => 'Docker & Kubernetes in Practice', 'price' => 49.99, 'discount' => null, 'level' => 'intermediate', 'hours' => 20, 'featured' => false, 'instructor' => 'Grace Muthoni'],
            ],
        ];

        foreach ($courses as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($items as $item) {
                $seed = urlencode($item['title']);
                Course::create([
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'description' => "Master {$item['title']} through hands-on projects, real-world examples and downloadable resources. Suitable for {$item['level']} learners, taught by {$item['instructor']}.",
                    'thumbnail' => "https://picsum.photos/seed/{$seed}/640/360",
                    'price' => $item['price'],
                    'discount_price' => $item['discount'],
                    'instructor_name' => $item['instructor'],
                    'level' => $item['level'],
                    'duration_hours' => $item['hours'],
                    'is_featured' => $item['featured'],
                ]);
            }
        }
    }
}
