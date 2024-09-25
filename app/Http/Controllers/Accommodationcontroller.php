<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'country' => 'required|string|max:255',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'city' => 'required|string|max:255',
            'type' => 'required|string',
        ]);


        $mainPhotoPath = null;
        if ($request->hasFile('main_photo')) {
            $mainPhotoPath = $request->file('main_photo')->store('accommodation/main_photos', 'public');
        }
        $accommodation = Accommodation::create(
            [
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'main_photo' => $mainPhotoPath,
                'country' => $validatedData['country'],
                'city' => $validatedData['city'],
                'type' => $validatedData['type']

            ]


        );
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('accommodation/photos/', 'public');
            $accommodation->photos()->create(
                [
                    'path' => $path
                ]

            );
        }

        return response()->json([
            'success' => true,
        ], 201);
    }
}
