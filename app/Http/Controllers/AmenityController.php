<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenityController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]

        );
        try {
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('amenities/icon', 'public');
            }
            $amenity = Amenity::create(
                [
                    'name' => $validatedData['name'],
                    'icon' => $iconPath
                ]
            );
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Amenity created successfully!',
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Something went wrong!' . $e->getMessage()
                ],
                500
            );
        }
    }
    public function delete($amenity_id)
    {
        $amenity = Amenity::find($amenity_id);
        $amenity->delete();
        return response()->json([
            'message' => 'Amenity deleted successfully.'
        ], 200);
    }
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255'

            ]
        );
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('amenities/icon', 'public');
            if ($amenity->icon && Storage::disk('public')->exists('amenities/icon', $amenity->icon)) {
                Storage::disk('public')->delete('amenities/icon', $amenity->icon);
            }
            $amenity->icon = $iconPath;
        }
        $amenity->name = $request->input('name');
        $amenity->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Amenity created successfully!',
                'icon_path' => $amenity->icon

            ],
            200
        );
    }
    public function storeAmenityToAccommodation(Request $request, $accommodation_id)
    {

        $validatedData = $request->validate(
            [
                'amenity' => 'required|string|max:255'
            ]
        );

        $amenity = Amenity::where('id', $validatedData['amenity'])->first();
        if (!$amenity) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Amenity does not exist'
                ],
                404
            );
        }
        $accommodation = Accommodation::findOrFail($accommodation_id);

        $accommodation->amenities()->attach($amenity->id, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Amenity created successfully!',
            ],
            200
        );
    }
}
