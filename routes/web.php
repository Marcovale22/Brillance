<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidaturaController;

Route::get('/', function () {
    return view('homepage');
})->name('home');

Route::post('/lavora-con-noi', [CandidaturaController::class, 'send'])->name('candidature.send');