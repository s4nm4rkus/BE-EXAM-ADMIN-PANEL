<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FactoryController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //BE Exam Routes
    Route::resource('factories', FactoryController::class);
    Route::resource('employees', EmployeeController::class);
});



require __DIR__.'/auth.php';
