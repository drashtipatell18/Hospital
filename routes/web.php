<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/forget-password', [DashboardController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('/forget-password', [DashboardController::class, 'sendResetLinkEmail'])->name('forget.password.email');
Route::get('/reset/{token}', [DashboardController::class, 'reset'])->name('reset');
Route::post('/reset/{token}', [DashboardController::class, 'postReset'])->name('post_reset');
Route::get('/cpassword',[HomeController::class,'cPassword'])->name('changepass');
Route::post('/changepassword',[HomeController::class,'changePassword'])->name('changePassword');

// user 

Route::get('/user', [UserController::class, 'users'])->name('user');
Route::get('/user/create',[UserController::class,'userCreate'])->name('create.user');
Route::post('/user/insert',[UserController::class,'userInsert'])->name('insert.user');
Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('edit.user');
Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('update.user');
Route::delete('/user/destroy/{id}',[UserController::class,'userDestroy'])->name('destroy.user');
Route::get('/user/my/profile', [UserController::class, 'myProfile'])->name('myprofile');
Route::get('/edit-profile/{id}', [UserController::class, 'editProfile'])->name('edit-profile');
Route::post('/update-profile/{id}', [UserController::class, 'Profileupdate'])->name('update-profile');

//Department

Route::get('/department', [DepartmentController::class, 'department'])->name('department');
Route::get('/department/create',[DepartmentController::class,'departmentCreate'])->name('create.department');
Route::post('/department/insert',[DepartmentController::class,'departmentInsert'])->name('insert.department');
Route::get('/department/edit/{id}', [DepartmentController::class, 'departmentEdit'])->name('edit.department');
Route::post('/department/update/{id}', [DepartmentController::class, 'departmentUpdate'])->name('update.department');
Route::delete('/department/delete/{id}', [DepartmentController::class, 'departmentDelete'])->name('destroy.department');

// Doctor

Route::get('/doctor', [DoctorController::class, 'doctor'])->name('doctor');
Route::get('/doctor/create',[DoctorController::class,'doctorCreate'])->name('create.doctor');
Route::post('/doctor/insert',[DoctorController::class,'doctorInsert'])->name('insert.doctor');
Route::get('/doctor/edit/{id}', [DoctorController::class, 'doctorEdit'])->name('edit.doctor');
Route::put('/doctor/update/{id}', [DoctorController::class, 'doctorUpdate'])->name('update.doctor');
Route::get('/doctor/delete/{id}', [DoctorController::class, 'doctorDelete'])->name('delete.doctor');