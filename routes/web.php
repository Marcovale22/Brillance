<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidaturaController;
use App\Http\Controllers\PreventivoController;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::post('/lavora-con-noi', [CandidaturaController::class, 'send'])->name('candidature.send');

Route::get('/servizi', function () {
    return view('servizi');
})->name('servizi');

Route::post('/preventivo', [PreventivoController::class, 'send'])->name('preventivo.send');