<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::upsert([
            ['name' => 'Womens', 'slug' => 'womens', 'category_code' => 'W'],
            ['name' => 'Mens', 'slug' => 'mens', 'category_code' => 'M'],
            ['name' => 'Kids', 'slug' => 'kids', 'category_code' => 'K'],
            ['name' => 'Home Goods', 'slug' => 'homegoods', 'category_code' => 'HG']
        ], ['category_code'],['name','slug']);
    }
}
