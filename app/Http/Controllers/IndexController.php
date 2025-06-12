<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('parent_category_id', null)->where('active', 1)->orderBy('name')->get();
        $result = [];

        foreach ($categories as $category) {
            // Get products from main category and subcategories
            $products = $category->getAllProductsRecursive();
            $products = $products->sortByDesc('likes');
            // Get and add products from subcategories
            $subcategories = Category::where('parent_category_id', $category->id)->get();
            $result[$category->name] = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'friendly_name' => $product->friendly_name,
                    'price_goal' => $product->price_goal,
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

    public function categoryOffers($name, Request $request)
    {
        $category = Category::where('name', $name)->first();
        $orderBy = $request->input('order', 'likes'); // default order by likes
        // Get all subcategories recursively
        $category->load('allChildCategories');
        $subcategories = $category->allChildCategories;
        
        // Map subcategories to include product count
        $subcategories = $subcategories->map(function($subcategory) {
            $subcategory->products_count = $subcategory->getAllProductsRecursive()->count();
            return $subcategory;
        });

        // Get all products recursively including from all nested subcategories
        $products = $category->getAllProductsRecursive();
        
        // Apply price range filters if they exist
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        if (!is_null($minPrice)) {
            $products = $products->filter(function($product) use ($minPrice) {
                return $product->last_price >= $minPrice;
            });
        }
        
        if (!is_null($maxPrice)) {
            $products = $products->filter(function($product) use ($maxPrice) {
                return $product->last_price <= $maxPrice;
            });
        }
        
        // Apply sorting based on order parameter
        switch($orderBy) {
            case 'name_asc':
                $products = $products->sortBy('friendly_name');
                break;
            case 'name_desc':
                $products = $products->sortBy('friendly_name')->reverse();
                break;
            case 'price_asc':
                $products = $products->sortBy('last_price');
                break;
            case 'price_desc':
                $products = $products->sortByDesc('last_price');
                break;
            default:
                $products = $products->sortByDesc('likes');
        }

        // Convert to collection and map before paginating
        $mappedProducts = $products->map(function ($product) {
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
        });
        
        // Paginate the mapped products
        $result = new \Illuminate\Pagination\LengthAwarePaginator(
            $mappedProducts->forPage($request->page ?? 1, 20),
            $mappedProducts->count(),
            20,
            $request->page ?? 1,
            ['path' => $request->url(), 'query' => $request->query()]
        );

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

    public function unlikeProduct($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        
        // Verificar si el usuario realmente dio like
        if (!$product->isLikedByUser($user->id)) {
            return response()->json([
                'error' => 'No has dado like a este producto',
                'likes' => $product->likes,
                'has_liked' => false
            ], 400);
        }

        // Quitar el like
        $product->likedByUsers()->detach($user->id);
        $product->decrement('likes');

        return response()->json([
            'likes' => $product->likes,
            'has_liked' => false
        ]);
    }

    public function reportProduct($id)
    {
         \DB::table('products')
            ->where('id', $id)
            ->update([
                'updated_at' => '2000-01-01 00:00:00'
            ]);

        return response()->json([
            'success' => true,
            'message' => '¡Gracias por tu reporte! Revisaremos el precio lo antes posible. Tu ayuda nos permite mantener los precios actualizados.'
        ]);
    }
}
