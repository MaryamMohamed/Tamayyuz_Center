<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;
use App\Models\Role;
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

Auth::routes();

//routes to get email and password verify
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Auth::routes(['verify' => true]);

//routes to login with facebook
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

//admin routes
Route::group(['prefix' => 'admin/', 'middleware' => ['role:administrator']], function(){
    # code...
    Route::get('dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('adminDashboard');
});

//user routes
Route::group(['prefix' => 'user/', 'middleware' => ['role:user']], function(){
    # code...
    Route::get('dashboard', 'App\Http\Controllers\UserController@dashboard')->name('userDashboard');    
});