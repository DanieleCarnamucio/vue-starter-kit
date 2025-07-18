<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/teams', [TeamController::class, 'getAll'])->name('get.teams');
