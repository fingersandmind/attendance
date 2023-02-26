<?php

use App\Http\Controllers\Admin\TeamController;
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
   Route::get('team', [TeamController::class, 'index'])->name('team.index');
});
