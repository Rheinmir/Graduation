<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class HomeController extends Controller
{
    // Display the home and about pages.
    public function index(){
        $topBanner = Banner::where('position','top-banner')->orderBy('priority','ASC')->first();
        return view('home.index');
    }

    public function about() {
        return view('home.about');
    }
}
