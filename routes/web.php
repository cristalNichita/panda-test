<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('subscribe', [App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('confirm/{token}', [App\Http\Controllers\SubscriptionController::class, 'confirm'])->name('confirmPage');
