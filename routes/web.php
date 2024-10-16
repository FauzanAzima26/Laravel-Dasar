<?php

use App\Http\Controllers\doctorController;
use App\Http\Middleware\Abc;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('doctor', [DoctorController::class, 'index'])->middleware(Abc::class);

Route::get('doctor/create', [DoctorController::class, 'create']);
Route::post('doctor/create', [DoctorController::class, 'store']);

Route::get('doctor/edit/{id}', [DoctorController::class, 'edit']);
Route::put('doctor/edit/{id}', [DoctorController::class, 'update']);

Route::delete('doctor/delete/{id}', [DoctorController::class, 'destroy']);

Route::get('doctor/search', [DoctorController::class, 'search']);