<?php

use \Illuminate\Support\Facades\Route;


Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::apiResource('payments',config('callmeaf-payment.controllers.payments'));
    Route::prefix('payments')->as('payments.')->controller(config('callmeaf-payment.controllers.payments'))->group(function() {
        Route::prefix('{payment}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
            Route::patch('/restore','restore')->name('restore');
            Route::delete('/force','forceDestroy')->name('force_destroy');
            Route::post('/documents','documentsUpdate')->name('documents.update');
        });
        Route::get('/trashed/index','trashed')->name('trashed.index');
    });
    Route::prefix('payment_items')->as('payment_items.')->controller(config('callmeaf-payment-item.controllers.payment_items'))->group(function() {
        Route::prefix('{payment_item}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
        });
    });
});
