<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pros;
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
