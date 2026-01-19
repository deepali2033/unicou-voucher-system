<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        
<<<<<<< HEAD
        // Redirect if profile already exists
        if ($user->studentProfile) {
            return redirect('/' . $user->role)->with('info', 'Profile already completed.');
        }

        return view('profile.student-form');
=======
        // // Redirect if profile already exists
        // if ($user->studentProfile) {
        //     return redirect('/' . $user->role)->with('info', 'Profile already completed.');
        // }

        return view('forms.student-form');
>>>>>>> deepali
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'id_document_type' => 'required|string',
            'id_document_no' => 'required|string',
            'contact_no' => 'required|string',
            'email' => 'required|email',
            'detail_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'post_code' => 'required|string',
            'whatsapp_no' => 'required|string',
            'id_document' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'purpose_of_exam' => 'required|in:Education,Migration,Other',
            'highest_education' => 'required|string',
            'passing_year' => 'required|string',
            'preferred_countries' => 'nullable|array',
            'bank_name' => 'nullable|string',
            'bank_address' => 'nullable|string',
            'bank_account_no' => 'nullable|string',
        ]);

        if ($request->hasFile('id_document')) {
            $path = $request->file('id_document')->store('documents', 'public');
            $validated['id_document_path'] = $path;
=======
        // dd('heloo');
        $user = Auth::user();

       $validated = $request->validate([
    'full_name' => 'required|string|max:255',
    'dob' => 'nullable|date',
    'id_type' => 'nullable|string',
    'id_no' => 'nullable|string',
    'phone' => 'required|string',
    'email' => 'required|email',

    'whatsapp' => 'nullable|string',
    'address' => 'nullable|string',
    'city' => 'nullable|string',
    'state' => 'nullable|string',
    'country' => 'nullable|string',
    'post_code' => 'nullable|string',

    'id_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
    'exam_purpose' => 'nullable|string',
    'highest_education' => 'nullable|string',
    'passing_year' => 'nullable|numeric',
    'preferred_countries' => 'nullable|array',

    'bank_name' => 'nullable|string',
    'bank_country' => 'nullable|string',
    'account_no' => 'nullable|string',
    're_upload_id_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',

    'consent' => 'required|accepted',
]);

        if ($request->hasFile('id_document')) {
            $validated['id_document'] = $request->file('id_document')->store('documents', 'public');
        }

        if ($request->hasFile('re_upload_id_document')) {
            $validated['re_upload_id_document'] = $request->file('re_upload_id_document')->store('documents', 'public');
>>>>>>> deepali
        }

        $validated['user_id'] = $user->id;
        
        StudentProfile::create($validated);

        // Mark user as active after profile completion if needed
        $user->update(['status' => 'active']);

        return redirect('/' . $user->role)->with('success', 'Profile completed and account activated!');
    }
}
