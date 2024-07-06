<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function logsindex()
    {
        // Fetch all activity logs, latest first
        $logs = Activity::with('causer', 'subject')->latest()->get();

        return view('logs', compact('logs'));
    }
}
