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

        $products = Product::where('friendly_name', 'LIKE', "%{$query}%")
            ->paginate(12);

        return view('searchOffers', compact('query', 'products'));

    }
}
