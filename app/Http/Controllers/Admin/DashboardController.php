<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'recentActivities' => ActivityLog::with('user')->latest()->limit(8)->get(),
        ]);
    }
}
