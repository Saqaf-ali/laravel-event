<?php

use App\Http\Controllers\Web\EventController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('about', function () {
    return Inertia::render('Web/About');
})->name('about');

Route::get('dashboard', function () {
    return Inertia::render(component: 'Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('events', EventController::class);
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/console.php';
require __DIR__ . '/admin.php';
