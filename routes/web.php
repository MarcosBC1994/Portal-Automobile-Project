<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login.form');

Route::resource('/employees', App\Http\Controllers\EmployeeController::class);

Route::resource('/trips', App\Http\Controllers\TripController::class);

Route::resource('/vehicles', App\Http\Controllers\VehicleController::class);

Route::resource('insurances', App\Http\Controllers\InsuranceController::class);

Route::delete('/employees.deleteSelected', [App\Http\Controllers\EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');




