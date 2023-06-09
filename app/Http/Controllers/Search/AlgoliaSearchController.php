<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class AlgoliaSearchController extends Controller
{
    public function index(){
        $query = request('item');
        $products = Product::search($query)->get();

        return Inertia::render('Searches/AlgoliaSearch/Index', compact('products'));
    }
}
