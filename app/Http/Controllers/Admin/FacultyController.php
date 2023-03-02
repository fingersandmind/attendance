<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::query()
                        ->paginate(10);

        return Inertia::render('Admin/Faculty/IndexPage', compact('faculties'));
    }

    public  function create()
    {
        return Inertia::render('Admin/Faculty/CreatePage');
    }

    public  function edit()
    {
        return Inertia::render('Admin/Faculty/EditPage');
    }
}
