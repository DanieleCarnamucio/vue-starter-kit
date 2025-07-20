<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return Inertia::render('GameInterface');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Game routes
Route::prefix('game')->group(function () {
    Route::post('/play', [GameController::class, 'play'])->name('play');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
