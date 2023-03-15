<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Home',
                'link' => route('home'),
            ],
            [
                'name' => 'Reports',
                'link' => '#',
            ],
        ];
        $logs = Log::with('user')
                    ->limit(20)
                    ->get();

        return Inertia::render('Admin/Reports/IndexPage', compact('logs', 'breadcrumbs'));
    }
}
