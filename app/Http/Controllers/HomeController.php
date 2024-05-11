<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index(){
        $topBanner = Banner::getBanner()->first();
        return view('home.index',compact('topBanner'));
    }

    public function about() {
        return view('home.about');
    }
}



        // $topBanner = Banner::where('position','top-banner')->orderBy('priority','ASC') -> first();
        // $gallerys = Banner::getBanner('gallery')->get();