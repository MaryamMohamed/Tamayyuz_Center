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

//Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcomeIndex');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'indexProduct'])->name('indexProduct');  
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

    //user manage routes
    Route::get('manage/user/index', 'App\Http\Controllers\AdminController@userIndex')->name('userIndex');
    Route::get('manage/user/create', 'App\Http\Controllers\AdminController@userCreate')->name('userCreate');
    Route::post('manage/user/store', 'App\Http\Controllers\AdminController@userStore')->name('userStore');
//  Route::post('manage/user/show/{id}', 'App\Http\Controllers\AdminController@userShow')->name('userShow');
    Route::get('manage/user/edit/{id}', 'App\Http\Controllers\AdminController@userEdit')->name('userEdit');
    Route::post('manage/user/update/{id}', 'App\Http\Controllers\AdminController@userUpdate')->name('userUpdate');
    Route::get('manage/user/delete/{id}', 'App\Http\Controllers\AdminController@userDelete')->name('userDelete');

    //product manage routes
    Route::get('manage/product/index', 'App\Http\Controllers\ProductController@index')->name('productIndex');
    Route::get('manage/product/create', 'App\Http\Controllers\ProductController@create')->name('productCreate');
    Route::post('manage/product/store', 'App\Http\Controllers\ProductController@store')->name('productStore');
    Route::get('manage/product/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('productEdit');
    Route::post('manage/product/update/{id}', 'App\Http\Controllers\ProductController@update')->name('productUpdate');
    Route::get('manage/product/delete/{id}', 'App\Http\Controllers\ProductController@destroy')->name('productDelete');
});

//user routes
Route::group(['prefix' => 'user/', 'middleware' => ['role:user']], function(){
    # code...
    Route::get('dashboard', 'App\Http\Controllers\UserController@dashboard')->name('userDashboard');    
});

//cart routes
Route::group(['middleware' => ['auth']], function(){
    # code...
    Route::get('cart', [App\Http\Controllers\ProductController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [App\Http\Controllers\ProductController::class, 'updateCart'])->name('update.cart');
    Route::delete('remove-from-cart', [App\Http\Controllers\ProductController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::get('checkout', [App\Http\Controllers\ProductController::class, 'Checkout'])->name('checkoutOrder');
});

//Route::get('addToCart/{$id}', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart');
