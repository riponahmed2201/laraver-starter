<?php

use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Backup\BackupDestination\Backup;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Roles and Users.
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

//Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
