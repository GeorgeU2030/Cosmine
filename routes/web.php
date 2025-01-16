<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Landing')->name('landing');

Route::inertia('/register', 'Auth/Register')->name('register');

Route::inertia('/login', 'Auth/Login')->name('login');