<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('Dashboard');
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/roles', [App\Http\Controllers\RoleController::class, 'create_role']);
Route::get('/roles/{id}', [App\Http\Controllers\RoleController::class, 'edit_role']);
Route::post('/role_store/{id}', [App\Http\Controllers\RoleController::class, 'store_role']);
Route::get('/role_delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy']);
Route::get('/restrict/{permission_id}/role/{role_id}', [App\Http\Controllers\RoleController::class, 'restrict']);
Route::get('/user/{user_id}/role/{role_id}', [App\Http\Controllers\RoleController::class, 'remove_role']);

Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index']);
Route::post('/permissions', [App\Http\Controllers\PermissionController::class, 'create_permission']);
Route::get('/permissions/{id}', [App\Http\Controllers\PermissionController::class, 'destroy']);

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('/profile/{id}', [App\Http\Controllers\UserController::class, 'edit_profile']);

Route::resource('users', 'App\Http\Controllers\UserController');
