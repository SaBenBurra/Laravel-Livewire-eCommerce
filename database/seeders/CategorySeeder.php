<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['clothes', 'phone', 'furniture', 'book', 'jewelry'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => $category,
            ]);
        }
    }
}
