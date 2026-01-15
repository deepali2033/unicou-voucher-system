<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8',
            'role' => 'required|in:manager,agent,support',
            'status' => 'required|in:active,pending,frozen',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:manager,agent,support',
            'status' => 'required|in:active,pending,frozen',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    /**
     * Login as the specified user.
     */
    public function loginAs(User $user)
    {
        // Prevent admin from logging as themselves or other admins if needed
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot impersonate another admin.');
        }

        session(['admin_id' => auth()->id()]);
        auth()->login($user);

        return redirect('/' . $user->role)->with('success', "Now logged in as {$user->name}");
    }

    /**
     * Stop impersonating and return to admin.
     */
    public function stopImpersonation()
    {
        $adminId = session('admin_id');
        if ($adminId) {
            $admin = User::find($adminId);
            if ($admin) {
                auth()->login($admin);
                session()->forget('admin_id');
                return redirect()->route('admin.dashboard')->with('success', 'Returned to Admin dashboard.');
            }
        }

        return redirect('/');
    }

    /**
     * Add credit to user account.
     */
    public function addCredit(Request $request, User $user)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:300',
        ], [
            'amount.max' => 'Maximum credit limit is USD 300.',
        ]);

        $user->credit += $validated['amount'];
        $user->save();

        // Log the transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'type' => 'credit_add',
            'status' => 'completed',
            'description' => 'Manual credit addition by Admin'
        ]);

        return back()->with('success', "USD {$validated['amount']} credit added to {$user->name}'s account.");
    }
}
