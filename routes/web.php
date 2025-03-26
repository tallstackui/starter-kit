<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/users', Index::class)->name('users.index');

    Route::get('/user/profile', Profile::class)->name('user.profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
