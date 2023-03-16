<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImagesRequest;
use Illuminate\View\View;
use App\Repositories\PhotosRepositoryInterface;

class PhotoController extends Controller
{
    public function create(): View
    {
        return view('photo');
    }

    // public function store(Request $request)
    // {
    //     $request->image->store(config('images.path'), 'public');

    //     return view('photo_ok');
    // } 

    public function store(ImagesRequest $request, PhotosRepositoryInterface $photosRepository): View
    {
        $photosRepository->save($request->image);

        return view('photo_ok');
    } 
}
