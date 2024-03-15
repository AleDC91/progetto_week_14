<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::resource('admin', AdminController::class)->middleware('auth', 'admin');
