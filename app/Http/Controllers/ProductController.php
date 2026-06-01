<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'user',
            'category',
            'images'
        ])->latest()->get();

        $categories = Category::all();

        return view('marketplace', compact(
            'products',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        
    }
}
