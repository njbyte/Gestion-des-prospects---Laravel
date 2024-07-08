<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\ProspectsExport;
use App\Exports\LogsExport;
use PDF;
use Illuminate\Support\Facades\Log;
use App\Models\Logs;




class AdminController extends Controller
{



public function index(Request $request)
{
    $auth = Auth::user(); // Fetch authenticated user
    $userName = $auth->name; // Assuming you want to pass the authenticated user's name
    $role=$auth->role;
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
        if ($role == 0) {
            return view('admin.ViewUsers2', compact('users', 'userName'));
        } else {
            return view('AccessDenied');
        }
    // Pass variables using compact function correctly
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
        $auth = Auth::user(); // Fetch authenticated user
    $userName = $auth->name;
    $role=$auth->role;
        // Pass users to the view
        if ($role == 0) {
            return view('admin.ViewProspectsV2', compact('prospects', 'userName'));
        } else {
            return view('AccessDenied');
        }

    }

    public function create()
    {$auth = Auth::user();
        $role=$auth->role;
        // Pass users to the view
        if ($role == 0) {
            return view('admin.CreateUser');
        } else {
            return view('AccessDenied');
        }
        // Logic to show create user form

    }

    public function createPros()
    {
        // Logic to show create Pros form
        // Example:
        $auth = Auth::user();
        $role=$auth->role;
        // Pass users to the view
        if ($role == 0) {
            return view('admin.CreatePros');
        } else {
            return view('AccessDenied');
        }

    }


public function store(Request $request)
{
    try {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:0,1,2',
            'password' => 'required|string|min:8',
        ]);

        // Create new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Check if user was successfully created
        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Failed to create user.');
        }

    } catch (QueryException $e) {
        // Handle specific database errors
        $errorCode = $e->errorInfo[1];
        if ($errorCode === 1062) { // MySQL error code for unique constraint violation
            return redirect()->back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
        } else {
            return redirect()->route('admin.users.index')->with('error', 'Database error: ' . $e->getMessage());
        }
    }
}

/* Show the json response

public function store(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|in:0,1,2',
                'password' => 'required|string|min:8',
            ]);

            // Create new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'password' => bcrypt($validatedData['password']),
            ]);

            // Check if user was successfully created
            if ($user) {
                return response()->json(['message' => 'User created successfully.', 'user' => $user], 201);
            } else {
                return response()->json(['error' => 'Failed to create user.'], 500);
            }

        } catch (QueryException $e) {
            // Handle specific database errors
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) { // MySQL error code for unique constraint violation
                return response()->json(['error' => 'The email has already been taken.'], 422);
            } else {
                return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
            }
        }
    } */


    public function storePros(Request $request)
    {
        if (!$request->has(['name', 'email', 'status'])) {
            // If the required data is not present, redirect to an error page
            return view('errors.error');
        }

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
        $auth = Auth::user(); // Fetch authenticated user
        $userName = $auth->name;
        $role=$auth->role;

        if ($role == 0) {
            return view('admin.EditUser', compact('user', 'userName', 'role'));
        } else {
            return view('AccessDenied');
        }
    }
    public function editPros(Pros $prospect)
    {
        $auth = Auth::user(); // Fetch authenticated user
        $userName = $auth->name;
        $role=$auth->role;

        if ($role == 0) {
            return view('admin.EditPros', compact('prospect', 'userName'));
        } else {
            return view('AccessDenied');
        }

    }
    public function update(Request $request, User $user)
{
    $auth = Auth::user();
    $role = $auth->role;

    if ($role == 0) {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:0,1,2',
            'password' => 'nullable|string|min:8',
        ]);

        // Capture old values
        $oldValues = $user->only(['name', 'email', 'role']);

        // Update user
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);

        // Capture new values
        $newValues = $user->only(['name', 'email', 'role']);

        // Log activity
        activity()
            ->useLog($role)
            ->causedBy($auth)
            ->performedOn($user)
            ->withProperties(['old' => $oldValues, 'new' => $newValues])
            ->log('User Update');

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    } else {
        return view('AccessDenied');
    }
}



public function updatePros(Request $request, Pros $prospect)
{
    $auth = Auth::user();
    $role = $auth->role;

    if ($role == 0) {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $prospect->id,
            'status' => 'required|in:0,1,2,3,4',
        ]);

        // Capture the old status before updating
        $oldStatus = $prospect->status;

        // Update Prospect
        $prospect->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'status' => $validatedData['status'],
        ]);

        // Log the activity with old and new statuses
        activity()->useLog($role)
            ->performedOn($prospect)
            ->causedBy($auth)
            ->withProperties([
                'from' => $oldStatus,
                'to' => $prospect->status,

            ])
            ->log("Prospect Update");

        return redirect()->route('admin.prospects')->with('success', 'Prospect updated successfully.');
    } else {
        return view('AccessDenied');
    }
}



    public function destroy(User $user)
    {$auth = Auth::user();
        $role=$auth->role;

        if ($role == 0) {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }else {
        return view('AccessDenied');
    }}

    public function destroyPros(Pros $prospect)
    {$auth = Auth::user();
        $role=$auth->role;

        if ($role == 0) {
        $prospect->delete();
        return redirect()->route('admin.prospects')->with('success', 'Prospect deleted successfully.');
    }else {
        return view('AccessDenied');
    }}


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




public function exportLogs($format)
    {
        // Fetch logs from the database
        $logs = Logs::with(['causer', 'subject'])->orderBy('created_at', 'desc')->get();

        // Handle export based on format
        switch ($format) {
            case 'xlsx':
                return Excel::download(new LogsExport($logs), 'Logs.xlsx');
            case 'csv':
                return Excel::download(new LogsExport($logs), 'Logs.csv');
            case 'txt':
                $txtContent = '';
                foreach ($logs as $log) {
                    $txtContent .= "Log Name: {$log->log_name}, Description: {$log->description}, Created At: {$log->created_at}\n";
                }
                $filename = 'logs.txt';
                return response($txtContent)
                        ->header('Content-Type', 'text/plain')
                        ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
            case 'pdf':
                            // Transform logs if necessary (for example, formatting dates or adding labels)
                            $logs->transform(function ($log) {
                                // Add any transformations needed here
                                return $log;
                            });

                            // Load the 'admin.pdfLogs' view with compacted $logs data
                            $pdf = PDF::loadView('admin.pdfLogs', compact('logs'));

                            // Return the PDF file for download with the name 'Logs.pdf'
                            return $pdf->download('Logs.pdf');}
    }

    public function showPdfLogs()
    {
        // Assuming you have a view for displaying PDF logs
        return view('admin.pdfLogs');
    }
}
