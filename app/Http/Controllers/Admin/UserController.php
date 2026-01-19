<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by account type
        if ($request->filled('account_type')) {
            $query->where('account_type', $request->get('account_type'));
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        // Append query parameters to pagination links
        $users->appends($request->query());

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'account_type' => 'required|in:user,freelancer,recruiter,admin',
            'company_name' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'account_type' => $request->account_type,
            'company_name' => $request->company_name,
            'password' => bcrypt('password123'), // Default password
        ]);

        // Create notification
        NotificationService::userCreated($user);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'account_type' => 'required|in:user,freelancer,recruiter,admin',
            'company_name' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'account_type' => $request->account_type,
            'company_name' => $request->company_name,
        ]);

        // Create notification
        NotificationService::userUpdated($user);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Verify user profile.
     */
    public function verifyProfile(User $user)
    {
        $admin = Auth::user();

        if ($user->verifyProfile($admin)) {
            return redirect()->back()->with('success', 'User profile verified successfully.');
        }

        return redirect()->back()->with('error', 'Failed to verify user profile.');
    }

    /**
     * Reject user profile.
     */
    public function rejectProfile(Request $request, User $user)
    {
        $request->validate([
            'notes' => 'nullable|string'
        ]);

        $admin = Auth::user();
        $notes = $request->input('notes', 'Profile verification rejected by admin.');

        if ($user->rejectProfile($admin, $notes)) {
            return redirect()->back()->with('success', 'User profile rejected successfully.');
        }

        return redirect()->back()->with('error', 'Failed to reject user profile.');
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'activated' : 'deactivated';

        // Create notification
        if ($user->is_active) {
            NotificationService::userActivated($user);
        } else {
            NotificationService::userDeactivated($user);
        }

        return redirect()->back()->with('success', "User has been {$status} successfully.");
    }

    /**
     * Approve user email.
     */
    public function approveEmail(User $user)
    {
        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->back()->with('success', 'User email approved successfully.');
        }

        return redirect()->back()->with('info', 'User email is already approved.');
    }

    /**
     * Disapprove user email.
     */
    public function disapproveEmail(User $user)
    {
        if ($user->email_verified_at) {
            $user->email_verified_at = null;
            $user->save();

            return redirect()->back()->with('success', 'User email disapproved successfully.');
        }

        return redirect()->back()->with('info', 'User email is already disapproved.');
    }
}
