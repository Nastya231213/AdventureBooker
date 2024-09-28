<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

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
}
