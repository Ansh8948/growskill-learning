<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'icon' => '💻', 'description' => 'HTML, CSS, JavaScript, Laravel, React and more.'],
            ['name' => 'Data Science', 'icon' => '📊', 'description' => 'Python, statistics, machine learning and analytics.'],
            ['name' => 'UI/UX Design', 'icon' => '🎨', 'description' => 'Figma, design systems, prototyping and research.'],
            ['name' => 'Mobile Development', 'icon' => '📱', 'description' => 'iOS, Android, Flutter and React Native.'],
            ['name' => 'Business & Marketing', 'icon' => '📈', 'description' => 'Growth, SEO, branding and entrepreneurship.'],
            ['name' => 'Cloud & DevOps', 'icon' => '☁️', 'description' => 'AWS, Docker, Kubernetes and CI/CD pipelines.'],
            
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'icon' => $category['icon'],
                'description' => $category['description'],
            ]);
        }
    }
}
