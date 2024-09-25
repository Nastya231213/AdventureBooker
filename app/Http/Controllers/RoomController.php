<?php

namespace App\Http\Controllers;

use App\Enums\RoomType;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'type' => ['required', 'string', 'in:' . implode(',', RoomType::getValues())],
                'price' => 'required|integer',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'capacity' => 'required|integer',
                'accommodation_id' => 'required|integer'

            ]
        );
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('rooms', 'public');
        }

        $newRoom = Room::create(
            [
                'type' => $validatedData['type'],
                'price' => $validatedData['price'],
                'room_photo' => $photoPath,
                'capacity' => $validatedData['capacity'],
                'accommodation_id' => $validatedData['accommodation_id']
            ]
        );
        return response()->json(
            [
                'success' => true,
                'message' => 'Room created successfully'
            ]
        );
    }
}
