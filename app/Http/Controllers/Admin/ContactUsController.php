<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of contact us submissions.
     */
    public function index()
    {
        $contacts = ContactUs::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.contact-us.index', compact('contacts'));
    }

    /**
     * Display the specified contact us submission.
     */
    public function show(ContactUs $contactUs)
    {
        $contactUs->load('user');
        return view('admin.contact-us.show', compact('contactUs'));
    }

    /**
     * Remove the specified contact us submission from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();

        return redirect()->route('admin.contact-us.index')
            ->with('success', 'Contact submission deleted successfully.');
    }
}
