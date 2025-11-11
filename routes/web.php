<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return redirect()->route('chat.index'); // ルートでチャットに飛ばす
});

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
});

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');
    Route::get('/calendar/events/{id}', [CalendarController::class, 'show'])->name('calendar.show');
});

require __DIR__ . '/auth.php';
