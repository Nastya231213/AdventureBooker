<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        return view('accommodation');
    }
    public function registrationSuccess(){

        return view('registrationSuccess');
    }
}
