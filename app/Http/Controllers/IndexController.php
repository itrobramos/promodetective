<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_category_id', null)->where('active', 1)->get();


        $result = [];

        foreach ($categories as $category) {
            
            $result[$category->name] = $category->offerProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'friendly_name' => $product->friendly_name,
                    'affiliate_url' => $product->affiliate_url,
                    'categoria_id' => $product->category_id,
                    'last_price' => $product->last_price,
                    'image_url' => $product->image_url,
                    'asin' => $product->asin,
                    'likes' => $product->likes,
                    'has_liked' => auth()->check() ? $product->isLikedByUser(auth()->id()) : false,
                    'is_lowest_price' => $product->last_price == $product->best_price,
                    'is_30_days_low' => $product->last_price < $product->price_goal && $product->last_price == $product->{'30days'}
    
                ];
            })->toArray();
        }

        return view('index', compact('categories', 'result'));
    }

    public function categoryOffers($name)
    {
        $category = Category::where('name', $name)->first();
        $subcategories = Category::where('parent_category_id', $category->id)
            ->get()
            ->map(function($subcategory) {
                $subcategory->products_count = $subcategory->categoryProducts()->count();
                return $subcategory;
            });

        // Get products from main category and subcategories
        $products = collect();
        
        // Add products from main category
        $products = $products->concat($category->categoryProducts);
        
        // Add products from subcategories
        foreach ($subcategories as $subcategory) {
            $products = $products->concat($subcategory->categoryProducts);
        }
        
        // Order by likes
        $products = $products->sortByDesc('likes');

        $result = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'friendly_name' => $product->friendly_name,
                'affiliate_url' => $product->affiliate_url,
                'categoria_id' => $product->category_id,
                'last_price' => $product->last_price,
                'price_goal' => $product->price_goal,
                'image_url' => $product->image_url,
                'asin' => $product->asin,
                'likes' => $product->likes,
                'has_liked' => auth()->check() ? $product->isLikedByUser(auth()->id()) : false,
                'is_lowest_price' => $product->last_price == $product->best_price,
                'is_30_days_low' => $product->last_price < $product->price_goal && $product->last_price == $product->{'30days'}
            ];
        })->toArray();

        return view('categoryOffers', compact('category', 'result', 'subcategories'));
    }

    public function likeProduct($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        
        // Verificar si el usuario ya dio like
        if ($product->isLikedByUser($user->id)) {
            return response()->json([
                'error' => 'Ya has dado like a este producto',
                'likes' => $product->likes,
                'has_liked' => true
            ], 400);
        }

        // Agregar el like
        $product->likedByUsers()->attach($user->id);
        $product->increment('likes');

        return response()->json([
            'likes' => $product->likes,
            'has_liked' => true
        ]);
    }
}
