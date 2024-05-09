<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Display the home and about pages.
    public function index(){
        return view('home.index');
    }

    public function about() {
        return view('home.about');
    }
}
