<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\MedicineController;

Route::get('/', function () {
    return view('welcome');
});

//residents
Route::resource('/residents', ResidentController::class);
Route::get('/residents/{id}', [ResidentController::class, 'destroy'])->name('residents.destroy');
Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
Route::get('/residents/{id}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
Route::put('/residents/{id}', [ResidentController::class, 'update'])->name('residents.update');

  //medicines
 Route::resource('medicines', MedicineController::class);
 Route::get('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
 Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');