<?php

namespace Database\Seeders;

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
            Product::create([
                'name' => 'Womens '.$i,
                'slug' => 'women-'.$i,
                'details' => 'womens hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => '-00',
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
            ]);
        }

        //Mens
        for($i=1; $i <= 12; $i++){
            Product::create([
                'name' => 'Mens '.$i,
                'slug' => 'men-'.$i,
                'details' => 'mens hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => '-00',
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
            ]);
        }

        //Kids
        for($i=1; $i <= 12; $i++){
            Product::create([
                'name' => 'Kids '.$i,
                'slug' => 'kid-'.$i,
                'details' => 'kids hoodie',
                'description' => fake()->paragraph(4),
                'product_code' => '-00',
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
            ]);
        }

        //Home goods
        for($i=1; $i <= 12; $i++){
            Product::create([
                'name' => 'Home goods '.$i,
                'slug' => 'homegoods-'.$i,
                'details' => 'homegods',
                'description' => fake()->paragraph(4),
                'product_code' => '-00',
                'price' => rand(999, 9999),
                'quantity' => rand(1,10),
            ]);
        }
    }
}
