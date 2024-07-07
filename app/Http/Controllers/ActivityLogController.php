<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function logsindex()
    {   $auth = Auth::user();
        $userName = $auth->name;
        $role = $auth->role;


    if ($role == 0) {
        // Fetch all activity logs, latest first
        $logs = Activity::with('causer', 'subject')->latest()->get();

        return view('logs', compact('logs','userName'));
    } else {
        return view('AccessDenied');
    }}
}
