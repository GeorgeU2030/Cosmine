<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;


// views

Route::inertia('/', 'Landing')->name('landing');

Route::inertia('/register', 'Auth/Register')->name('register');

Route::inertia('/login', 'Auth/Login')->name('login');

Route::inertia('/home', 'Home')->name('home');

// controllers

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);