<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request, Accommodation $accommodation)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'main_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'country' => 'required|string|max:255',
            'photos.*' => 'mimes:jpeg,png,jpg,gif|max:2048',
            'city' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        try {
            $mainPhotoPath = $accommodation->main_photo; 

            if ($request->hasFile('main_photo')) {
                Storage::disk('public')->delete($accommodation->main_photo);
                $mainPhotoPath = $request->file('main_photo')->store('accommodation/main_photo', 'public');
            }
            if ($request->hasFile('photos') && is_array($request->file('photos'))) {
                $current_photos = $accommodation->photos();

                foreach ($current_photos as $photo) {
                    Storage::disk('public')->delete($photo->path);
                    $photo->delete();
                }

                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('accommodation/photos', 'public');
                    $accommodation->photos()->create(
                        ['path' => $path]
                    );
                }
            }
            $accommodation->update([
                'main_photo' => $mainPhotoPath,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'type' => $request->input('type'),
                'country' => $request->input('country'),
            ]);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'The accommodation was successfully updated'
                ],
                201
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage(),

                ],
                500
            );
        }
    }
}
