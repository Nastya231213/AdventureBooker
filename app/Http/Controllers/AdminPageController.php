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


        $amenitiesCount = Amenity::count();
        $accommodtionCount = Accommodation::count();

        return view('admin.dashboard', [
            'amenitiesCount' => $amenitiesCount,
            'accomodationCount' => $accommodtionCount
        ]);
    }
    public function editUser($user_id)
    {

        $user = User::find($user_id);
        return view('admin.users.edit', ['user' => $user]);
    }
    public function editAmenity($amenity_id)
    {
        $amenity = Amenity::find($amenity_id);
        return view('admin.amenities.edit', compact('amenity'));
    }
    public function editAccommodation($accommodation_id)
    {
        $accommodationTypes = AccommodationType::cases();
        $accommodation = Accommodation::find($accommodation_id);
        return view('admin.accommodation.edit',['accommodation'=>$accommodation,'accommodationTypes'=>$accommodationTypes]);
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

        $accommodation->load(['photos', 'amenities']);

        return view('admin.accommodation.show', compact('accommodation'));
    }
    public function createAmenity()
    {

        return view('admin.amenities.create');
    }
    public function addAmenity(Accommodation $accommodation)
    {
        $existingAmenityIds = $accommodation->amenities->pluck('id')->toArray();


        $amenities = Amenity::whereNotIn('id', $existingAmenityIds)->get();

        return view('admin.amenities.add-amenity', ['amenities' => $amenities, 'accommodation' => $accommodation]);
    }
}
