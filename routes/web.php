<?php

use App\Http\Controllers\VendingMachineController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VendingMachineController::class, 'index'])->name('index');
Route::get('/registration/addition', [VendingMachineController::class, 'showAdditionForm'])->name('registration.addition');
Route::post('/registration/addition', [VendingMachineController::class, 'store'])->name('registration.addition.form');  
Route::put('/registration/addition', [VendingMachineController::class, 'update'])->name('registration.addition.update');  

Route::get('/registration/detail/{id}', [VendingMachineController::class, 'showEditForm'])->name('registration.detail');  
Route::get('/registration/edit/{id}', [VendingMachineController::class, 'edit'])->name('registration.edit');
Route::put('/update/{id}', [VendingMachineController::class, 'update'])->name('registration.update');

Route::post('/destroy/{id}',[VendingMachineController::class, 'destroy'])->name('registration.destroy');