<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;




// Registration routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Home Page 
Route::get('/', [HomeController::class, 'home'])->middleware('auth')->name('home');

// Profile route
Route::get('/profile', [AuthController::class, 'showProfile'])->middleware( 'auth')->name('profile');
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->middleware( 'auth')->name('profile.edit');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware( 'auth')->name('profile.update');


// Public Profile Route
Route::get('/user/{user_id}', [HomeController::class, 'publicProfile'])->middleware( 'auth')->name('user.public.profile');


// user single post routes
Route::resource('post', PostController::class)->except(['index']);



