<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Womens
        for($i=1; $i <= 12; $i++){
            $category = Category::find(1);
            $product = Product::create([
                'name' => 'Womens '.$i,
                'slug' => 'women-'.$i,
                'details' => 'womens hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => $category->category_code . '-00' . $i,
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
                'main_image' => 'products/womens-' . $i . '.png'
            ]);

            $product->categories()->attach($category);
        }

        //Mens
        for($i=1; $i <= 12; $i++){
            $category = Category::find(2);
            $product = Product::create([
                'name' => 'Mens '.$i,
                'slug' => 'men-'.$i,
                'details' => 'mens hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => $category->category_code . '-00' . $i,
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
                'main_image' => 'products/mens-' . $i . '.png'
            ]);
            $product->categories()->attach($category);
        }

        //Kids
        for($i=1; $i <= 12; $i++){
            $category = Category::find(3);
            $product = Product::create([
                'name' => 'Kids '.$i,
                'slug' => 'kid-'.$i,
                'details' => 'kids hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => $category->category_code . '-00' . $i,
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
                'main_image' => 'products/kids-' . $i . '.png'
            ]);
            $product->categories()->attach($category);
        }

        //Home goods
        for($i=1; $i <= 12; $i++){
            $category = Category::find(4);
            $product = Product::create([
                'name' => 'Home goods '.$i,
                'slug' => 'homegoods-'.$i,
                'details' => 'homegods',
                'description' => fake()->paragraph(4),
                'product_code' => $category->category_code . '-00' . $i,
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
                'main_image' => 'products/homegoods-' . $i . '.png'
                
            ]);
            $product->categories()->attach($category);
        }

        $product = Product::find(1);
        $product->categories()->attach(4);
    }
}
