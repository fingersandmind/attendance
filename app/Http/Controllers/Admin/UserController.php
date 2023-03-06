<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $searchTerm = $request->get('searchTerm') ?? '';
        $users = User::query()
            ->search($searchTerm)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Users/IndexPage', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Admin/Users/CreatePage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email|max:50',
            'password' => 'required|confirmed|string|min:5|max:30',
        ]);

        User::create($validatedData);

        return to_route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): \Inertia\Response
    {
        return Inertia::render('Admin/Users/SinglePage', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|min:5|max:30',
            'email' => 'sometimes|required|email|max:50',
        ]);
        if(!is_null($request->get('password')))
        {
            $validatedData = array_merge($validatedData, $request->validate([
                'password' => 'required|confirmed|string|min:5|max:30',
            ]));
        }
        $user->update($validatedData);

        return to_route('admin.users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
