<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\ProspectsExport;
use PDF;


class AdminController extends Controller
{
    public function index(Request $request)
    {

            $search = $request->input('search');

            $users = User::query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere(function ($query) use ($search) {
                    $query->where('role', 0)->whereRaw("0 LIKE ?", ["%{$search}%"])
                        ->orWhere('role', 1)->whereRaw("1 LIKE ?", ["%{$search}%"])
                        ->orWhere('role', 2)->whereRaw("2 LIKE ?", ["%{$search}%"]);
                })
                ->get();

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


    public function export($format)
    {
        if ($format === 'xlsx') {
            return Excel::download(new UsersExport, 'users.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new UsersExport, 'users.csv');
        }elseif ($format === 'txt') {
            $users = User::all();
            $users->transform(function ($user) {
                switch ($user->role) {
                    case 0:
                        $user->role_label = 'Admin';
                        break;
                    case 1:
                        $user->role_label = 'Qualificateur';
                        break;
                    case 2:
                        $user->role_label = 'Commercial';
                        break;
                    }
                    return $user;
                });// Fetch users data
            $txtContent = '';
            foreach ($users as $user) {
                $txtContent .= "Name: {$user->name}, Email: {$user->email}, Role: {$user->role_label}\n";
            }
            $filename = 'users.txt';
            return response($txtContent)
                    ->header('Content-Type', 'text/plain')
                    ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

        }elseif ($format === 'pdf') {
            $users = User::all(); // Fetch users data
            $users->transform(function ($user) {
                switch ($user->role) {
                    case 0:
                        $user->role_label = 'Admin';
                        break;
                    case 1:
                        $user->role_label = 'Qualificateur';
                        break;
                    case 2:
                        $user->role_label = 'Commercial';
                        break;
                    }
                    return $user;
                });
                $pdf = PDF::loadView('admin.pdf', compact('users'));
                return $pdf->download('users.pdf');
        }

        abort(404); // Handle invalid format or other cases
    }

    public function showPdf()
{
    return view('admin.pdf');
}

public function exportPros($format)
    {
        if ($format === 'xlsx') {
            return Excel::download(new ProspectsExport, 'Prospects.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new ProspectsExport, 'Prospects.csv');
        }elseif ($format === 'txt') {
            $users = Pros::all();
            $users->transform(function ($user) {
                switch ($user->status) { // -- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->
                    case 0:
                        $user->status_label = 'Nouveau';
                        break;
                    case 1:
                        $user->status_label = 'Qualifié';
                        break;
                    case 2:
                        $user->status_label = 'Rejeté';
                        break;
                    case 3:
                        $user->status_label = 'Converti';
                        break;
                    case 4  :
                        $user->status_label = 'Cloturé';
                        break;
                    }
                    return $user;
                });
            $txtContent = '';
            foreach ($users as $user) {
                $txtContent .= "Name: {$user->name}, Email: {$user->email}, Status: {$user->status_label}\n";
            }
            $filename = 'Prospects.txt';
            return response($txtContent)
                    ->header('Content-Type', 'text/plain')
                    ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');

        }elseif ($format === 'pdf') {
            $users = Pros::all(); // Fetch users data
            $users->transform(function ($user) {
                switch ($user->status) { // -- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->
                    case 0:
                        $user->status_label = 'Nouveau';
                        break;
                    case 1:
                        $user->status_label = 'Qualifié';
                        break;
                    case 2:
                        $user->status_label = 'Rejeté';
                        break;
                    case 3:
                        $user->status_label = 'Converti';
                        break;
                    case 4  :
                        $user->status_label = 'Cloturé';
                        break;
                    }
                    return $user;
                });
                $pdf = PDF::loadView('admin.pdfPros', compact('users'));
                return $pdf->download('Prospects.pdf');
        }

        abort(404); // Handle invalid format or other cases
    }

    public function showPdfPros()
{
    return view('admin.pdfPros');
}
}
