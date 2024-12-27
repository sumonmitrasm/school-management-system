<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
   // \Artisan::call('optimize');
    dd("All clear!");
});


Route::get('/',[AuthController::class, 'login']);
Route::post('login',[AuthController::class, 'Authlogin']);
Route::get('logout',[AuthController::class, 'logout']);
Route::get('forgot-password',[AuthController::class, 'forgotPassword']);
Route::post('post-forgot-password',[AuthController::class, 'PostforgotPassword']);

// Route::get('admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('admin/admin/list', function () {
    return view('admin.admin.list');
});
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Create Admin Middleware>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::group(['middleware' => 'admin'], function(){
// 	Route::get('admin/dashboard', function () {
// 	    return view('admin.dashboard');
// 	});
// });
Route::group(['middleware' => 'admin'], function(){
	Route::get('admin/dashboard',[DashboardController::class, 'dashboard']);
});
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Create Teacher Middleware>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::group(['middleware' => 'teacher'], function(){
	Route::get('teacher/dashboard',[DashboardController::class, 'dashboard']);
});
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Create Student Middleware>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::group(['middleware' => 'parent'], function(){
	Route::get('parent/dashboard',[DashboardController::class, 'dashboard']);
});
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Create Parent Middleware>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::group(['middleware' => 'student'], function(){
	Route::get('student/dashboard',[DashboardController::class, 'dashboard']);
});