<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\DroneController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PilotsController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\WordController;

Route::middleware("auth:admin")->group(function()
{
    Route::get('/dashboard', [MainController::class, 'index'])->name('admin.dashboard');


    Route::resource('users', UserController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('models', ModelController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::resource('drones', DroneController::class);
    Route::resource('pilots', PilotsController::class);


    Route::post('/models/test', [MainController::class, 'updatemodel']);

    Route::controller(WordController::class)->group(function()
    {
        Route::post('user/info', 'user_info')->name('user.info');
        Route::post('application/info', 'application')->name('application.info');
    });

    Route::controller(ApplicationController::class)->group(function()
    {
        Route::get('/application/all', 'admin_index')->name('admin.application.list');
        Route::get('/application/active', 'admin_active')->name('admin.application.active');
        Route::post('/application/store', 'store')->name('admin.application.store');
        Route::get('/application/{id}/show', 'admin_show')->name('admin.application.show');
        Route::post('/application/{id}/status', 'application_status')->name('admin.application.status');
    });
});