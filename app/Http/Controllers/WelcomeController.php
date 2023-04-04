<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $categories = Category::take(4)->inRandomOrder()->get(['name', 'slug']);
        $products = Product::all();
        $featured = Product::where('main_image', '!=', 'default/no_image.jpg')->take(4)->inRandomOrder()->get(['name', 'slug', 'main_image']);
        return Inertia::render('Welcome', compact('products', 'categories', 'featured'));
    }

}
