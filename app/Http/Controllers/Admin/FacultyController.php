<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Faculty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FacultyController extends Controller
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->get('searchTerm') ?? '';
        $faculties = Faculty::query()
                ->search($searchTerm)
                ->latest()
                ->paginate(10)
                ->withQueryString();

        return Inertia::render('Admin/Faculty/IndexPage', compact('faculties'));
    }

    public function show(Faculty $faculty)
    {
        return Inertia::render('Admin/Faculty/SinglePage', [
            'faculty' => $faculty,
            'attendances' => $faculty->attendances()->latest()->paginate(5)
        ]);
    }

    /**
     * @return Response
     */
    public  function create()
    {
        return Inertia::render('Admin/Faculty/CreatePage');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'firstname' => 'required|string|min:5|max:30',
            'lastname' => 'required|string|min:5|max:30',
            'middlename' => 'required|string|min:5|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'nullable|string',
            'country' => 'required|string|max:50',
            'address' => 'required|string'
        ]);

        Faculty::create($validatedData);

        return to_route('admin.faculties.index');
    }

    /**
     * @return Response
     */
    public  function edit(Faculty $faculty)
    {
        return Inertia::render('Admin/Faculty/EditPage', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'firstname' => 'required|string|min:5|max:30',
            'lastname' => 'required|string|min:5|max:30',
            'middlename' => 'required|string|min:5|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'nullable|string',
            'country' => 'required|string|max:50',
            'address' => 'required|string'
        ]);

        $faculty->update($validatedData);

        return to_route('admin.faculties.show', ['faculty' => $faculty->id]);
    }

    public function logShow(Request $request, Faculty $faculty)
    {
        $dates = $request->get('dates') ?? [];

        return Inertia::render('Admin/Faculty/Logs/LogsIndex', [
            'faculty' => $faculty,
            'dates' => $dates,
            'attendances' => fn() => $this->getLogs($faculty->id, $dates)
        ]);
    }

    public function getLogs($facultyId, $dates)
    {
        if(empty($dates)) return [];
        return Attendance::query()
                        ->where('faculty_id', $facultyId)
                        ->whereBetween('created_at', $dates)
                        ->paginate(15);
    }
}
