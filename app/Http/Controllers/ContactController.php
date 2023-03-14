<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class ContactController extends Controller
{
    //
    public function create() : View
    {
        return view('contact');
    }

    public function store(Request $request) : View
    {
        // $this->validate($request, [
        //     'nom' => 'bail|required|between:5,20|alpha',
        //     'email' => 'bail|required|email',
        //     'message' => 'bail|required|max:250'
        // ]);
        Mail::to('example@example.com')
        ->send(new Contact($request->except('_token'))); // comme l'envoi d'emails peut prendre du temps, on utilisera "queue" plutôt que "send"
        return view('confirm');
    }
}
