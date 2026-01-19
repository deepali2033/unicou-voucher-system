<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display the contact us page.
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'form_fields.name_contact_form' => 'required|string|max:255',
            'form_fields.email_contact_form' => 'required|email|max:255',
            'form_fields.phone_contact_form' => 'required|string|max:20',
            'form_fields.subject_contact_form' => 'required|string|max:255',
            'form_fields.info_contact_form' => 'required|string',
        ]);

        // Extract the form fields
        $formFields = $request->input('form_fields');

        // Create the contact submission
        $contact = ContactUs::create([
            'name' => $formFields['name_contact_form'],
            'email' => $formFields['email_contact_form'],
            'phone' => $formFields['phone_contact_form'],
            'subject' => $formFields['subject_contact_form'],
            'message' => $formFields['info_contact_form'],
            'user_id' => auth()->check() ? auth()->id() : null,
        ]);

        // Notify all admins about the new contact submission
        $admins = User::where('account_type', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'New Contact Form Submission',
                'description' => "New contact request from {$contact->name} regarding: {$contact->subject}",
                'type' => 'contact',
                'action' => route('admin.contact-us.show', $contact->id),
                'related_id' => $contact->id,
                'is_read' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
