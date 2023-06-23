<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [
                'name' => 'Home',
                'link' => route('admin.home'),
            ],
            [
                'name' => 'Settings',
                'link' => '#',
            ],
        ];
        $setting = Setting::query()
                        ->where('type', 'time')
                        ->first();
        return Inertia::render('Admin/Settings/IndexPage', compact('setting', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstIn' => 'required|string',
            'firstOut' => 'required|string|date_format:H:i:s',
            'secondIn' => 'required|string|date_format:H:i:s',
            'secondOut' => 'required|string|date_format:H:i:s',
        ]);
        Setting::updateOrCreate(
            ['type' => 'time'],
            [
                'first_in' => $validatedData['firstIn'],
                'first_out' => $validatedData['firstOut'],
                'second_in' => $validatedData['secondIn'],
                'second_out' => $validatedData['secondOut'],
            ]
        );
        return to_route('admin.faculties.index');
    }
}
