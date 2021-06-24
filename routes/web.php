<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
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

Route::get('dashboard', [WebAuthController::class, 'dashboard']);
Route::get('login', [WebAuthController::class, 'index'])->name('login');
Route::post('custom-login', [WebAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [WebAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [WebAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [WebAuthController::class, 'signOut'])->name('signout');
