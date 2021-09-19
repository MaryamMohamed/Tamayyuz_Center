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
    Route::get('manage/user/index', 'App\Http\Controllers\AdminController@userIndex')->name('userIndex');
    Route::get('manage/user/create', 'App\Http\Controllers\AdminController@userCreate')->name('userCreate');
    Route::post('manage/user/store', 'App\Http\Controllers\AdminController@userStore')->name('userStore');
//  Route::post('manage/user/show/{id}', 'App\Http\Controllers\AdminController@userShow')->name('userShow');
    Route::get('manage/user/edit/{id}', 'App\Http\Controllers\AdminController@userEdit')->name('userEdit');
    Route::post('manage/user/update/{id}', 'App\Http\Controllers\AdminController@userUpdate')->name('userUpdate');
    Route::get('manage/user/delete/{id}', 'App\Http\Controllers\AdminController@userDelete')->name('userDelete');
});

//user routes
Route::group(['prefix' => 'user/', 'middleware' => ['role:user']], function(){
    # code...
    Route::get('dashboard', 'App\Http\Controllers\UserController@dashboard')->name('userDashboard');    
});