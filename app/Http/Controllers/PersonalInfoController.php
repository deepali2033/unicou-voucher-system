<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Auth;

class PersonalInfoController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        if ($user->personalInfo) {
            return $this->redirectBasedOnRole($user);
        }
        return view('profile.personal-info');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'full_name' => 'required|string|max:200',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state_province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $validated['user_id'] = $user->id;

        PersonalInfo::create($validated);

        return $this->redirectBasedOnRole($user);
    }

    private function redirectBasedOnRole($user)
    {
        if ($user->role === 'student') {
            return redirect()->route('profile.student.form');
        }
        
        // For other roles, redirect to their respective dashboard or generic profile
        return redirect('/' . $user->role)->with('success', 'Personal info saved!');
    }
}
