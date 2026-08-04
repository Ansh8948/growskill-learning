<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Save contact
        $contact = Contact::create($validated);

        // Get admin dynamically
        $admin = User::where('is_admin', 1)->first();

        if ($admin) {
            Mail::to($admin->email)->send(new ContactFormMail($contact));
        }

        return back()->with('success', 'Your message has been sent successfully.');
    }
}