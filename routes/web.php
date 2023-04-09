<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin

Route::controller(AdminPageController::class)
->prefix('admin')
->group(function () {
      Route::get('login', 'login')->name('admin/login');
      Route::post('login', 'login')->name('admin/login/action');
      Route::get('forgot-password', 'forgot_password')->name('admin/forgot-password');
      Route::post('forgot-password', 'forgot_password')->name('admin/forgot-password/action');

      Route::get('logout', 'logout')->name('admin/logout');

      // admin auth middleware..
      Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', 'dashboard')->name('admin/dashboard');           
      });

});