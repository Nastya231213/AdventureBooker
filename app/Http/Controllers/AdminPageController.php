<?php

namespace App\Http\Controllers;

use App\Enums\AccommodationType;
use App\Enums\RoomType;
use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Amenity;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function editUser($user_id)
    {

        $user = User::find($user_id);
        return view('admin.users.edit', ['user' => $user]);
    }
    public function editAmenity($amenity_id)
    {
        $amenity = Amenity::find($amenity_id);
        return view('admin.amenities.edit',compact('amenity'));
    }
    public function createAccommodation()
    {
        $accommodationTypes = AccommodationType::cases();

        return view('admin.accommodation.create', compact('accommodationTypes'));
    }
    public function createRoom(Accommodation $accommodation)
    {
        if (in_array($accommodation->type, AccommodationType::roomSupportedTypes())) {
            $roomTypes = RoomType::cases();
            return view('admin.rooms.create', ["roomTypes" => $roomTypes, "accommodation" => $accommodation]);
        }
        return redirect()->back()->with('error', 'Rooms cannot be created for this type of accommodation');
    }
    public function accommodation()
    {
        $accommodation = Accommodation::with('rooms')->paginate(6);
        return view('admin.accommodation.index', ['accommodation' => $accommodation]);
    }
    public function amenities()
    {

        $amenities = Amenity::paginate(5);
        return view('admin.amenities.index', compact('amenities'));
    }
    public function showAccommodation(Accommodation $accommodation)
    {

        $accommodation->load('photos');

        return view('admin.accommodation.show', compact('accommodation'));
    }
    public function createAmenity()
    {

        return view('admin.amenities.create');
    }
}
     