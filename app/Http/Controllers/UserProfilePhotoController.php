<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfilePhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:1024']
        ]);

        $user = auth()->user();

        // Delete old photo if exists
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Store the new photo
        $path = $request->file('photo')->store('profile-photos', 'public');
        
        $user->profile_photo_path = $path;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile photo updated successfully'
        ]);
    }

    public function destroy()
    {
        $user = auth()->user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile photo removed successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No profile photo to remove'
        ], 404);
    }
}
