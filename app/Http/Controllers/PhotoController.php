<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(): View
    {
        return view('photo');
    }

    public function store(Request $request)
    {
        $request->image->store(config('images.path'), 'public');

        return view('photo_ok');
    } 
}
