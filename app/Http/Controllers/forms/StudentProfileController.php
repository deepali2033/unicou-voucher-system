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
        
        // Redirect if profile already exists
        if ($user->studentProfile) {
            return redirect('/' . $user->role)->with('info', 'Profile already completed.');
        }

        return view('profile.student-form');
    }

    public function store(Request $request)
    {
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
        }

        $validated['user_id'] = $user->id;
        
        StudentProfile::create($validated);

        // Mark user as active after profile completion if needed
        $user->update(['status' => 'active']);

        return redirect('/' . $user->role)->with('success', 'Profile completed and account activated!');
    }
}
