<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function index()
    {
        $team = [];

        return Inertia::render('Admin/Team/IndexPage', compact('team'));
    }
}
