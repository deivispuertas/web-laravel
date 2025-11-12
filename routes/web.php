<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

Route::post('/answers/{question}', [AnswerController::class, 'store'])->name('answers.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
});

require __DIR__.'/auth.php';
