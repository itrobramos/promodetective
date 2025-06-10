<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserProfileController extends Controller
{    public function show()
    {
        // Obtener el usuario actual y cargar sus relaciones necesarias
        $user = auth()->user();
        
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'notifications' => 'required|in:all,important,none',
        ]);

        $user->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Perfil actualizado correctamente'
        ]);
    }
}
