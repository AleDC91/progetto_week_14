<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::resource('activities', ActivityController::class)->except(['create', 'store'])->middleware('auth');

Route::get('/projects/{project}/activities/create', [ActivityController::class, 'create'])->name('activities.create')->middleware('auth');
Route::post('/projects/{project}/activities', [ActivityController::class, 'store'])->name('activities.store')->middleware('auth');
