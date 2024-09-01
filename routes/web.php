<?php

use App\Exports\AttendancesExport;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ReportsController;
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


Route::get('/', function () {
    return Inertia::render('Home');
});

Route::group(['middleware' => 'auth:web', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Faculty
    Route::resource('faculties', FacultyController::class);
    Route::get('logs/{faculty}', [FacultyController::class, 'logShow'])->name('logs.show');

    // Users
    Route::resource('users', UserController::class);

    //Calendars
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');

    //Settings
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::get('reports', [ReportsController::class, 'index'])->name('reports');

    Route::post('/import-excel', [ExcelController::class, 'import'])->name('import.excel');

    Route::get('attendances/export', function () {
        return Excel::download(new AttendancesExport, 'attendances.xlsx');
    })->name('export.attendances');
});
