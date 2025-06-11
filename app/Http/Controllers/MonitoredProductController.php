<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MonitoredProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'asin' => 'required|string|min:10|max:10'
        ]);

        try {
            $product = Product::firstOrCreate(
                ['asin' => $request->asin],
                [
                    'name' => 'Producto ' . $request->asin,
                    'friendly_name' => 'Producto ' . $request->asin,
                    'last_price' => 0,
                    'category_id' => 1 // Categoría por defecto
                ]
            );

            // Agregar el producto a los favoritos del usuario si no lo está ya
            $user = auth()->user();
            if (!$user->likes()->where('product_id', $product->id)->exists()) {
                $user->likes()->attach($product->id);
            }

            return response()->json([
                'success' => true,
                'message' => 'Producto agregado correctamente',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al agregar el producto: ' . $e->getMessage()
            ], 500);
        }
    }
}
