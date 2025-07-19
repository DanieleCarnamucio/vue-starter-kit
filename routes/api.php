<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\TeamController;

Route::get('/teams', [TeamController::class, 'getAll'])->name('get.teams');
