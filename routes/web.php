<?php

use App\Http\Controllers\Web\AttendeeController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\OrderItemController;
use App\Http\Controllers\Web\PurchasedTicketController;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Pest\Collision\Events;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('about', function () {
    return Inertia::render('Web/About');
})->name('about');
Route::get('contact', function () {
    return Inertia::render('Web/Contact');
})->name('contact');

Route::prefix('web')
    ->name('web.')
    ->group(function () {
        Route::resource('events', EventController::class);
        Route::get('shopping', function () {
            return Inertia::render('Web/carts/Shopping');
        })->name('shopping');
        Route::get('checkout', function () {
            return Inertia::render('Web/carts/Checkout');
        })->name('checkout');

        //
        Route::middleware('auth')->group(function () {
            //    orders
            Route::resource('orders', OrderController::class)->only(['store', 'index', 'show']);
            //    order items
            Route::resource('order_items', OrderItemController::class)->only(['index', 'show']);
            //    purchased tickets
            Route::resource('purchased_tickets', PurchasedTicketController::class)->only(['index','show']);
        });
    });

Route::resource('contacts', ContactController::class);

Route::get('dashboard', function () {
    return Inertia::render(component: 'Dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/console.php';
require __DIR__ . '/admin.php';
