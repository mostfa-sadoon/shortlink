<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['throttle:20,1'])->group(function () {
    Route::get('/shorten', [UrlShortenerController::class, 'index'])->name('index');
    Route::post('/shorten', [UrlShortenerController::class, 'shorten'])->name('shorten.store');
    Route::get('/{short_code}', [UrlShortenerController::class, 'redirect'])->name('redirect');
    Route::get('/analytics/{short_code}', [UrlShortenerController::class, 'analytics']);
});
