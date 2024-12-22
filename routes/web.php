<?php

use App\Http\Controllers\ProfileController;
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
});

Route::resource('accreditedsamplingstatuses', \App\Http\Controllers\AccreditedSamplingStatusController::class);
Route::resource('humviresponsibles', \App\Http\Controllers\HumviResponsibleController::class);
Route::resource('samples', \App\Http\Controllers\SampleController::class);

Route::get('/ivoviz-mintaveteli-pontok', function () {
    return view('ivoviz_mintaveteli_pontok');
})->name('ivoviz_mintaveteli_pontok');

require __DIR__.'/auth.php';
