<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('admin.users.edit',['user'=>$user]);
    }
}
