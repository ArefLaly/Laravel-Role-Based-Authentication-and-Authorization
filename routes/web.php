<?php

use App\Common\CheckPermission;
use App\Common\Permission\Permissions;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::middleware(['auth'])->group(function () {

    Route::get('users', [UserController::class, "index"])->name("user.index")->can('viewAny', User::class);
    Route::get('users/add', [UserController::class, "create"])->name("user.add")->can('create', User::class);
    Route::post('users/add', [UserController::class, "store"])->name("user.add")->can('create', User::class);
    Route::post('users/logout', [UserController::class, 'logout'])->name("logout");
    Route::delete('users/delete/{user}', [UserController::class, 'destroy'])->name('user.delete')->can('delete', 'user');
    Route::get('users/edit/{user}', [UserController::class, "edit"])->name("user.edit")->can('update', 'user');
    Route::put('users/edit/{user}', [UserController::class, "update"])->name("user.edit")->can('update', 'user');
    Route::get('users/details/{user}', [UserController::class, "show"])->name("user.details")->can('view', 'user');
    Route::get('users/profile', [UserController::class, "profile"])->name("user.profile");
    Route::put('users/profile', [UserController::class, "updateProfile"])->name("user.updateProfile");
    Route::put('users/changeStatus/{user}', [UserController::class, "changeStatus"])->name("user.status")->can('update', 'user');


    Route::get('roles', [RoleController::class, "index"])->name("role.index")->can('viewAny', Role::class);
    Route::get('roles/add', [RoleController::class, "create"])->name("role.add")->can('create', Role::class);
    Route::post('roles/add', [RoleController::class, "store"])->name("role.add")->can('create', Role::class);
    Route::get('roles/details/{role}', [RoleController::class, "show"])->name("role.details")->can('view', 'role');

    Route::delete('roles/delete/{role}', [RoleController::class, 'destroy'])->name('role.delete')->can('delete', 'role');
    Route::get('roles/edit/{role}', [RoleController::class, "edit"])->name("role.edit")->can('update', 'role');
    Route::put('roles/edit/{role}', [RoleController::class, "update"])->name("roles.edit")->can('update', 'role');
});
Route::get('users/login', [UserController::class, 'login'])->name('login');
Route::post('users/login', [UserController::class, 'auth'])->name("auth");
