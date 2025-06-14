<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return redirect()->back();
        }

        $productsQuery = Product::where('friendly_name', 'LIKE', "%{$query}%");
        
        // Aplicar filtros de precio
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        
        if ($minPrice) {
            $productsQuery->where('last_price', '>=', $minPrice);
        }
        
        if ($maxPrice) {
            $productsQuery->where('last_price', '<=', $maxPrice);
        }
        
        // Aplicar ordenamiento
        switch($request->input('order')) {
            case 'price_asc':
                $productsQuery->orderBy('last_price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('last_price', 'desc');
                break;
            case 'name_asc':
                $productsQuery->orderBy('friendly_name', 'asc');
                break;
            case 'name_desc':
                $productsQuery->orderBy('friendly_name', 'desc');
                break;
            default:
                $productsQuery->orderBy('likes', 'desc');
        }
        
        $products = $productsQuery->paginate(12);
        
        return view('searchOffers', compact('query', 'products'));

    }
}
