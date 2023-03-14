<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //
    public function create() : View
    {
        return view('contact');
    }

    public function store(ContactRequest $request) : View
    {
        return view('confirm');
    }
}
