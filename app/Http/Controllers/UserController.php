<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
