<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
//exporting lib
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommercialProspectsExport;

use App\Exports\QualificateurProspectsExport;

use PDF;
class QualificateurController extends Controller
{

    public function viewprospects(Request $request)
    {

        $auth = Auth::user(); // Fetch authenticated user
        $userName = $auth->name;
        // Fetch authenticated user


        $role=$auth->role;

        if ($role == 1) {
        // Fetch all users
        $search = $request->input('search');

        $prospects = Pros::query()
        ->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })
        ->where(function ($query) {
            $query->where('status', 1)
                  ->orWhere('status', 0);
        })
        ->get();




            return view('qualificateur.ViewProspectsV2', compact('prospects','userName'));
    }else {
        return view('AccessDenied');
    }}

    public function editPros(Pros $prospect)
    { $auth = Auth::user();
        $role=$auth->role;
        $userName = $auth->name;
        if ($role == 1) {
        return view('qualificateur.EditPros', compact('prospect','userName'));
    }else {
        return view('AccessDenied');
    }}

    public function updatePros(Request $request, Pros $prospect)
    {
        $authUser = Auth::user();
        $role = $authUser->role;

        if ($role == 1) {
            // Validate request data
            $validatedData = $request->validate([
                'status' => 'required|in:0,1,2,3,4',
            ]);

            // Update Prospect
            $prospect->update([
                'status' => $validatedData['status'],
            ]);

            // Log activity
            activity()
                ->causedBy($authUser)
                ->performedOn($prospect)
                ->withProperties(['status' => $validatedData['status']])
                ->log('Prospect status updated');

            return redirect()->route('qualif.prospects')->with('success', 'Prospect updated successfully.');
        } else {
            return view('AccessDenied');
        }
    }


    public function exportPros($format)
    {
        if ($format === 'xlsx') {
            return Excel::download(new QualificateurProspectsExport, 'Prospects.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new QualificateurProspectsExport, 'Prospects.csv');
        }elseif ($format === 'txt') {


            $users = Pros::query()
            ->where('status', 1)
            ->orwhere('status', 0)
                ->get();
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
            $users = Pros::query()
            ->where('status', 1)
            ->orwhere('status', 0)
                ->get(); // Fetch users data
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
