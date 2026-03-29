<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ServiceLink;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'totalPages' => Page::count(),
            'publishedPages' => Page::where('is_published', true)->count(),
            'activeServiceLinks' => ServiceLink::where('is_active', true)->count(),
            'recentActivities' => ActivityLog::with('user')->latest()->limit(8)->get(),
        ]);
    }
}
