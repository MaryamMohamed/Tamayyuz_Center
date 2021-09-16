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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Auth::routes(['verify' => true]);


Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::group(['middleware'=>['role:administrator']], function(){
        # code...
        Route::resource('users','UsersController');
        Route::resource('permission','PermissionController');
        Route::resource('role','RoleController');
    }
);
/*
Route::get('/newPermission', function(){
    # code...
    $createProduct = App\Models\Permission::create([
        'name' => 'create-product',
        'display_name' => 'Create Products', // optional
        'description' => 'create new products', // optional
        ]);

    $editProduct = App\Models\Permission::create([
        'name' => 'edit-product',
        'display_name' => 'Edit Products', // optional
        'description' => 'edit products data', // optional
        ]);

    $deleteProduct = App\Models\Permission::create([
        'name' => 'delete-product',
        'display_name' => 'Delete Products', // optional
        'description' => 'delete products from database', // optional
        ]);
});
*/