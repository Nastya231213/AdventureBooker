<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phoneNum' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create(
            [
                'name' => $request->input('firstName'),
                'surname' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phoneNum'),
                'password' => Hash::make($request->input('password')),
            ]
        );
        return response()->json(['success' => true, 'message' => 'Registration successful']);
    }
}
