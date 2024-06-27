<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;

class QualificateurController extends Controller
{
    public function viewprospects()
    {
        // Fetch all users
        $prospects = Pros::all(); //<!-- 0: Nouveau / 1:Qualifié 2: Rejeté 3: converti 4: cloturé-->

        // Pass users to the view
        return view('admin.ViewProspects', compact('prospects'));
    }

    public function editPros(Pros $prospect)
    {
        return view('admin.EditPros', compact('prospect'));
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
}
