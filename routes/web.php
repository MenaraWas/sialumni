<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TracerPublicController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('tracer')->name('tracer.')->group(function () {
    
    Route::get('/', [TracerPublicController::class, 'landing'])->name('landing');
    Route::get('/isi', [TracerPublicController::class, 'form'])->name('form');
    Route::post('/isi', [TracerPublicController::class, 'submit'])->name('submit');
    Route::get('/terima-kasih', [TracerPublicController::class, 'thankyou'])->name('thankyou');

});


