<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventImageController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    // users routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/users/trashed', 'trashed')->name('users.trashed');
        Route::put('/users/{user}/restore', 'restore')->name('users.restore')->withTrashed();
        Route::delete('/users/{user}/delete', 'delete')->name('users.delete')->withTrashed();
    });
    Route::resource('users', UserController::class);

    // organizer routes
    Route::controller(OrganizerController::class)->group(function () {
        Route::get('/organizers/trashed', 'trashed')->name('organizers.trashed');
        Route::put('/organizers/{organizer}/restore', 'restore')->name('organizers.restore')->withTrashed();
        Route::delete('/organizers/{organizer}/delete', 'delete')->name('organizers.delete')->withTrashed();
    });
    Route::resource('organizers', OrganizerController::class);
    // RootRoute::resource('attendees', AttendeeController::class);

    // event routes
    Route::controller(EventController::class)->group(function () {
        Route::get('/events/trashed', 'trashed')->name('events.trashed');
        Route::put('/events/{event}/restore', 'restore')->name('events.restore')->withTrashed();
        Route::delete('/events/{event}/delete', 'delete')->name('events.delete')->withTrashed();
    });

    Route::resource('events', EventController::class);
    Route::resource('event.eventImages', EventImageController::class)
        ->parameters(['eventImages' => 'image'])
        ->only(['store', 'create']);
    Route::resource('event_images', EventImageController::class)->except(['store', 'create', 'show', 'index']);
});

Route::get('test', function () {
    return dd('saqaf');
})->name('saqaf');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
