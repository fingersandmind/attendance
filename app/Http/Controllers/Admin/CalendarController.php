<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
//        dd($this->getDates());
        return Inertia::render('Admin/Calendars/IndexPage');
    }

    public function getDates()
    {
        $weeks = [
            'Sun' => 'Sunday',
            'Mon' => 'Monday',
            'Tue' => 'Tuesday',
            'Wed' => 'Wednesday',
            'Thu' => 'Thursday',
            'Fri' => 'Friday'
        ];

        $now = Carbon::now();
        $totalDaysOfMonth = $now->daysInMonth;
        $dayOfMonthStarted = $now->startOfMonth()->shortEnglishDayOfWeek;
        return $dayOfMonthStarted;
    }
}
