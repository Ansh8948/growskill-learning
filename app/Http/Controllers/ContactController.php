<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255'],
            'subject'   => ['required', 'string', 'max:255'],
            'message'   => ['required', 'string', 'max:2000'],
        ]);

        Contact::create($validated);

        return back()->with('success', 'Your message has been sent successfully.');
    }
}