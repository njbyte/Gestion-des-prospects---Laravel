<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all();

        // Pass users to the view
        return view('admin.ViewUsers', compact('users'));
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }


    public function viewprospects()
    {
        // Fetch all users
        $prospects = Pros::all();

        // Pass users to the view
        return view('admin.ViewProspects', compact('prospects'));
    }

    public function create()
    {
        // Logic to show create user form
        // Example:
        return view('admin.CreateUser');
    }

    public function createPros()
    {
        // Logic to show create Pros form
        // Example:
        return view('admin.CreatePros');
    }
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:0,1,2',
            'password' => 'required|string|min:8',
        ]);

        // Create new user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
        ]);


        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function storePros(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:prospects,email',
            'status' => 'required|in:0,1,2,3,4',

        ]);

        // Create new Pros
        Pros::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'status' => $validatedData['status'],

        ]);


        return redirect()->route('admin.prospects')->with('success', 'Prospect created successfully.');
    }
    public function edit(User $user)
    {
        return view('admin.EditUser', compact('user'));
    }
    public function editPros(Pros $prospect)
    {
        return view('admin.EditPros', compact('prospect'));
    }

    public function update(Request $request, User $user)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:0,1,2',
            'password' => 'nullable|string|min:8',
        ]);

        // Update user
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,

        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function updatePros(Request $request, Pros $prospect)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $prospect->id,
            'status' => 'required|in:0,1,2,3,4',

        ]);

        // Update Prospect
        $prospect->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'status' => $validatedData['status'],

        ]);

        return redirect()->route('admin.prospects')->with('success', 'Prospect updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function destroyPros(Pros $prospect)
    {
        $prospect->delete();
        return redirect()->route('admin.prospects')->with('success', 'Prospect deleted successfully.');
    }

}
