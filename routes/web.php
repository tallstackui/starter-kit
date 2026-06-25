<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

// Users will be redirected to this route if not logged in
Route::livewire('/login', 'pages::auth.login')->name('login');
Route::livewire('/register', 'pages::auth.register')->name('register');

// Define the logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');
    Route::livewire('/user/profile', 'pages::user.profile')->name('user.profile');
});
