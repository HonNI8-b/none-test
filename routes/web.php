<?php

use App\Http\Controllers\VendingMachineController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VendingMachineController::class, 'index'])->name('index');
Route::get('/registration/addition', [VendingMachineController::class, 'showAdditionForm'])->name('registration.addition');
Route::post('/registration/addition', [VendingMachineController::class, 'showAdditionForm'])->name('registration.addition.form');
Route::post('/post',[VendingMachineController::class, 'store'])->name('store');