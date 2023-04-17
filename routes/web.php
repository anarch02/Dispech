<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Organization\DashboardController;
use App\Http\Controllers\Organization\DroneController;
use App\Http\Controllers\Organization\PilotController;
use App\Http\Controllers\Organization\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/map', function () {
    return view('map');
});

Route::controller(LoginController::class)->group(function()
{
    Route::post('/login', 'login')->name('login_proccess');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware("auth:web")->group(function()
{
    Route::controller(DashboardController::class)->group(function()
    {
        Route::get('/dashborad', 'index')->name('organization.dashboard');
    });

    Route::controller(UserController::class)->group(function()
    {
        Route::get('/users', 'index')->name('organization.users');
    });

    Route::controller(DroneController::class)->group(function()
    {
        Route::get('/drones', 'index')->name('organization.drones');
    });

    Route::controller(PilotController::class)->group(function()
    {
        Route::get('/pilots', 'index')->name('organization.pilots');
    });

    Route::controller(ApplicationController::class)->group(function()
    {
        Route::get('/application/list', 'index')->name('organization.application.list');
        Route::get('/application/create', 'create')->name('organization.application.create');
        Route::get('/application/{id}/show', 'show')->name('organization.application.show');
        Route::post('/application/store', 'store')->name('organization.application.store');
    });

    Route::get('/profile', function()
    {
        return view('organizations.profile');
    })->name('profile');

});