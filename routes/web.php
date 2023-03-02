<?php

use App\Http\Controllers\Admin\FacultyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function(){
    return view('home');
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('team', [FacultyController::class, 'index'])->name('team.index');
    Route::get('team/create', [FacultyController::class, 'create'])->name('team.create');
    Route::get('team/{user}/create', [FacultyController::class, 'edit'])->name('team.edit');
});
