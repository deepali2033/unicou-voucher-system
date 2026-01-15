<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showRegisterRole()
    {
        return view('auth.register-role');
    }

    public function showRegister($role)
    {
        $validRoles = ['manager', 'support', 'student', 'reseller_agent'];
        if (!in_array($role, $validRoles)) {
            return redirect('/register-role')->with('error', 'Invalid role');
        }
        return view('auth.register', ['role' => $role]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:password',
            'role' => 'required|in:manager,support,student,reseller_agent',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => app()->environment('local') ? 'active' : 'pending',
        ]);

        if (app()->environment('local')) {
            $user->markEmailAsVerified();
        }

        event(new Registered($user));

        Auth::login($user);

        if (app()->environment('local')) {
            return redirect('/' . $user->role)->with('success', 'Registration successful! (Auto-verified for local)');
        }

        return redirect('/email/verify')->with('success', 'Registration successful! Please check your email for verification link.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect('/' . $user->role);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
