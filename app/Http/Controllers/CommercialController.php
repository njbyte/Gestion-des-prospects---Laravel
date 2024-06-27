<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
class CommercialController extends Controller
{
    public function viewprospects()
    {
        // Fetch all users
        $prospects = Pros::where('status', 1)->get(); //<!-- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->

        // Pass users to the view
        return view('commercial.ViewProspects', compact('prospects'));
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
}
