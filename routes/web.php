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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/gen', [App\Http\Controllers\HomeController::class, 'genEmailPwd']);

    // Employee
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index']);
    Route::post('/employee/get-employees', [App\Http\Controllers\EmployeeController::class, 'getEmployees']);
    Route::post('/employee/get-add-placements', [App\Http\Controllers\EmployeeController::class, 'getAddPlacements']);

    // Client
    Route::get('/client', [App\Http\Controllers\ClientController::class, 'index']);
    Route::post('/client/get_clients', [App\Http\Controllers\ClientController::class, 'getClients']);
    // Add client
    Route::post('/client/get_business_info', [App\Http\Controllers\ClientController::class, 'getBusinessInfo']);
    Route::post('/client/get_contact_info', [App\Http\Controllers\ClientController::class, 'getContactInfo']);
    Route::post('/client/get_add_confidential', [App\Http\Controllers\ClientController::class, 'getAddConfidential']);
    Route::post('/client/get_placemetns', [App\Http\Controllers\ClientController::class, 'getPlacements']);
    Route::post('/client/get_documents', [App\Http\Controllers\ClientController::class, 'getDocuments']);
});