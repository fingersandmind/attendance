<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Setting;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $attendances = Attendance::with('faculty')
            ->whereDoesntHave('faculty', function($query) {
                $query->onlyTrashed();
            })
            ->paginate(10);

        $setting = Setting::where('type', 'time')->first();

        return Inertia::render('Welcome', [
            'attendances' => $attendances,
            'setting' => $setting,
        ]);
    }
}
