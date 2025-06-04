<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_category_id', null)->get();


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

        //order by likes 
        $products = $category->categoryProducts;
        $products = $products->sortByDesc('likes');

        $result = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'friendly_name' => $product->friendly_name,
                'affiliate_url' => $product->affiliate_url,
                'categoria_id' => $product->category_id,
                'last_price' => $product->last_price,
                'image_url' => $product->image_url,
                'asin' => $product->asin,
                'likes' => $product->likes,
                'is_lowest_price' => $product->last_price == $product->best_price,
                'is_30_days_low' => $product->last_price < $product->price_goal && $product->last_price == $product->{'30days'}
            ];
        })->toArray();

        return view('categoryOffers', compact('category', 'result'));
    }

    public function likeProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->increment('likes');
        return response()->json(['likes' => $product->likes]);
    }
}
