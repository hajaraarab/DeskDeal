<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\support\SustainabilityCalculator;

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

            'images.*' => 'nullable|bail|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'images.*.image' => 'Het bestand moet een afbeelding zijn.',
            'images.*.mimes' => 'Alleen JPG, JPEG en PNG bestanden zijn toegestaan.',
            'images.*.max' => 'Een afbeelding mag maximaal 2 MB groot zijn.',
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

        if ($request->filled('province')) {
            $province = $request->get('province');
            $products->where('location', 'like', "%{$province}%");
        }

        if ($request->filled('q')) {
            $query = $request->get('q');

            $products->where(function ($builder) use ($query) {
                $builder->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            });
        }

        return view('partials.product-list', [
            'products' => $products->latest()->get()
        ]);
    }
    public function show(Product $product)
    {
        $product->load(['images', 'category', 'user']);

        $relatedProducts = Product::with(['images', 'category'])
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        
        $sustainability = SustainabilityCalculator::calculate($product);

        return view('products.show', compact('product', 'relatedProducts', 'sustainability'));
    }
    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('products.create', [
            'product' => $product,
            'categories' => $categories,
            'isEdit' => true,
        ]);
    }
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category_id' => 'required',
            'price' => 'nullable|numeric',
        ]);

        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'category_id' => $validated['category_id'],
            'price' => $request->has('free_product') ? null : $validated['price'],
            'is_free' => $request->has('free_product'),
        ]);
        
        if ($request->delete_images) {

            $imageIds = explode(',', $request->delete_images);

            $images = ProductImage::whereIn('id', $imageIds)->get();

            foreach ($images as $image) {

                Storage::disk('public')->delete($image->image_path);

                $image->delete();
            }
        }
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product succesvol bijgewerkt.');
    }
    public function myProducts()
    {
        $products = Product::with([
            'user',
            'category',
            'images'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        $categories = Category::all();

        return view('products.mine', compact(
            'products',
            'categories'
        ));
    }
}
