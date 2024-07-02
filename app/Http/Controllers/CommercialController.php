<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
//exporting lib
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommercialProspectsExport;
use PDF;
class CommercialController extends Controller
{
    public function viewprospects(Request $request)
    {
        // Fetch all users
         //<!-- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->

            $search = $request->input('search');

            $prospects = Pros::query()
                ->where('status', 1)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                })
                ->get();

            return view('commercial.ViewProspectsV2', compact('prospects'));
        }

    public function editPros(Pros $prospect)
    {
        return view('commercial.EditPros', compact('prospect'));
    }

    public function updatePros(Request $request, Pros $prospect)
    {
        // Validate request data
        $validatedData = $request->validate([

            'status' => 'required|in:0,1,2,3,4',

        ]);

        // Update Prospect
        $prospect->update([

            'status' => $validatedData['status'],

        ]);

        return redirect()->route('comm.prospects')->with('success', 'Prospect updated successfully.');
    }


    public function exportPros($format)
    {
        if ($format === 'xlsx') {
            return Excel::download(new CommercialProspectsExport, 'Prospects.xlsx');
        } elseif ($format === 'csv') {
            return Excel::download(new CommercialProspectsExport, 'Prospects.csv');
        }elseif ($format === 'txt') {


            $users = Pros::query()
                ->where('status', 1)
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
