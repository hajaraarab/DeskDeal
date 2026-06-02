<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with([
            'user',
            'category',
            'images'
        ]); 

        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        $products = $products->latest()->get();
        
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            
            'free_product' => 'nullable|boolean',

            'price' => [
                'nullable', 
                'numeric', 
                'min:0'
            ],

            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $isFree = $request->boolean('free_product'); 

        if(!$isFree) {
            $request->validate([
                'price' => 'required|numeric|min:0.01'
            ], [
                'price.required' => 'Gelieve een prijs in te vullen of "Gratis aanbieden" aan te vinken.', 
                'price.min' => 'De prijs moet groter zijn dan €0.'
            ]);
        }

        $product = Product::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],

            'price' => $isFree ? null : $validated['price'], 
            'is_free' => $isFree, 
            
            'status' => 'available',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect('/marketplace')
            ->with('success', 'Je product werd succesvol toegevoegd.');
    }
    public function filter(Request $request)
    {
        $products = Product::with(['images', 'category']);

        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        return view('partials.product-list', [
            'products' => $products->latest()->get()
        ]);
    }
    public function show(Product $product)
    {
        $product->load(['images', 'category', 'user']);
        
        return view('products.show', compact('product'));
    }
}
