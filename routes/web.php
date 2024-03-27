<?php

use App\Http\Controllers\VendingMachineController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//Route::get('/', [VendingMachineController::class, 'index'])->name('index');
Route::get('/registration/addition', [VendingMachineController::class, 'showAdditionForm'])->name('registration.addition');
Route::post('/registration/addition', [VendingMachineController::class, 'store'])->name('registration.addition.form');  
Route::put('/registration/addition', [VendingMachineController::class, 'update'])->name('registration.addition.update');  

Route::get('/registration/detail/{id}', [VendingMachineController::class, 'showEditForm'])->name('registration.detail');  
Route::get('/registration/edit/{id}', [VendingMachineController::class, 'edit'])->name('registration.edit');
Route::put('/update/{id}', [VendingMachineController::class, 'update'])->name('registration.update');

// 削除
Route::post('/destroy/{id}',[VendingMachineController::class, 'destroy'])->name('registration.destroy');

// 検索
Route::get('/search', [SearchController::class, 'index'])->name('registration.index');
Route::get('/registration/search', [SearchController::class, 'index'])->name('registration.search');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// 未ログイン時のページ偏移
Route::middleware(['auth'])->group(function () {
    Route::get('/', [VendingMachineController::class, 'index'])->name('index');
    Route::get('/registration', [VendingMachineController::class, 'index'])->name('registration.index'); // 名前を修正
    Route::get('/registration/addition', [VendingMachineController::class, 'showAdditionForm'])->name('registration.addition'); // 名前を修正
    //Route::get('/registration/edit', [VendingMachineController::class, 'index'])->name('registration.index'); // 名前を修正
    Route::get('/registration/detail', [VendingMachineController::class, 'index'])->name('registration.index'); // 名前を修正
});


