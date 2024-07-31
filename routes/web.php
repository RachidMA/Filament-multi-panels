<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return redirect()->route('filament.auth.auth.login');
});

//ROUTES FOR BART TO CREATE NEW PANELS USER AS ADMINS==PIZZAPANEL, REAL-ESTATE, EVENT-MANAGEMENT
//THESE ROUTES NEED TO BE PROTECTED ONLY FOR SUPERADMIN=BART
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// routes/web.php
Route::get('/get-userable-options', [EmployeeController::class, 'getUserableOptions']);
