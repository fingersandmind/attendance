<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\UserController;
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
    // Faculty
    Route::resource('faculties', FacultyController::class);
    Route::get('logs/{faculty}', [FacultyController::class, 'logShow'])->name('logs.show');

    // Users
    Route::resource('users', UserController::class);

    //Calendars
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
});
