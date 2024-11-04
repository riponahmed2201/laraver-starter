<?php

use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MenuBuilderController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Roles and Users.
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

//Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

//Secuirity
Route::get('profile/secuirity', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::put('profile/secuirity', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

//Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

//Pages
Route::resource('pages', PageController::class);

//Menu
Route::resource('menus', MenuController::class)->except(['show']);

//Menu Builder
Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}'], function () {
    Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');

    Route::get('item/create', [MenuBuilderController::class, 'itemCreate'])->name('item.create');
});
