<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function create(): View
    {
        return view('contacts');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'message' => 'bail|required|max:500'
        ]);

        \App\Models\Contact::create([
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // $contact = new \App\Models\Contact;
        // $contact->email = $request->email;                   On peut utiliser cette méthode ou celle du dessus. (privilégier celle du dessus)
        // $contact->message = $request->message;
        // $contact->save();
        return "C'est bien enregistré !";
    }
}
