<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TMDBController;

// views

Route::inertia('/', 'Landing')->name('landing');

Route::inertia('/register', 'Auth/Register')->name('register');

Route::inertia('/login', 'Auth/Login')->name('login');

Route::inertia('/home', 'Home')->name('home');

Route::inertia('/movies', 'Movies')->name('movies');

Route::inertia('/series', 'Series')->name('series');

Route::inertia('/detail/{type}/{id}', 'Detail')->name('detail');

// controllers

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/api/search', [TMDBController::class, 'search']);

Route::post('/save-rating', [TMDBController::class, 'saveRating'])->name('save.rating');

// get data

Route::get('/home', [TMDBController::class, 'index']);

Route::get('/detail/{type}/{id}', [TMDBController::class, 'detail'])->name('detail');