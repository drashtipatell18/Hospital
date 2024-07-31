<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    if(Auth::user())
    {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/login',[HomeController::class,'Login'])->name('login');
Route::post('/loginstore',[HomeController::class,'LoginStore'])->name('loginstore');
Route::get('/logout',[HomeController::class,'Logout'])->name('logout');