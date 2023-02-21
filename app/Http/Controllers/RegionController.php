<?php

namespace App\Http\Controllers;

class RegionController extends Controller
{
    public function index()
    {
        return view('pages.region.index');
    }

    public function create()
    {
        return view('pages.region.create');
    }
}
