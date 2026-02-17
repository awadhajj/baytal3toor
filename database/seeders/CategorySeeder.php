<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'عطور رجالية', 'slug' => 'mens-perfumes', 'image' => 'categories/mens-perfumes.jpg'],
            ['name' => 'عطور نسائية', 'slug' => 'womens-perfumes', 'image' => 'categories/womens-perfumes.jpg'],
            ['name' => 'عطور مشتركة', 'slug' => 'unisex-perfumes', 'image' => 'categories/unisex-perfumes.jpg'],
            ['name' => 'بخور وعود', 'slug' => 'oud-incense', 'image' => 'categories/oud-incense.jpg'],
            ['name' => 'مخلطات عطرية', 'slug' => 'perfume-blends', 'image' => 'categories/perfume-blends.jpg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
