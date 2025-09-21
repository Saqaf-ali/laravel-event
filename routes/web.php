<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render(component: 'Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('test', function () {
    return Inertia::render('Test');
})->name('test');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('rasg', OrganizerController::class);
    Route::resource('users', UserController::class);
    // RootRoute::resource('attendees', AttendeeController::class);
});

Route::get('test', function () {
    return dd('saqaf');
})->name('saqaf');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
