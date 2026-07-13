<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function locations()
    {
        return view('locations');
    }

    public function insurance()
    {
        return view('insurance');
    }
}
