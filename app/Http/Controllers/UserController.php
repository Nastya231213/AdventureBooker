<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('admin.users.list', ['users' => $users]);
    }
    public function delete($user_id)
    {

        $user = User::find($user_id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully.'
        ], 200);
    }
    public function create()
    {

        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $profile_photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('profile_photos', 'public');
            $profile_photo = basename($photoPath);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'required|numeric',
        ]);

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($request->input('password')),
                'phone_number' => $validatedData['phone_number'],
                'profile_photo' => $profile_photo,
                'is_admin' => $request->has('is_admin') ? 1 : 0
            ]);

            return response()->json([
                'success'=>true,
                'message' => 'User created successfully',
            ], 201);
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'User creation failed',
            ], 500);
        }
    }
}
