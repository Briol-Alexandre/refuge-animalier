<?php

use App\Http\Controllers\AdoptionsController;

return [
    Route::get('/adoptions', [AdoptionsController::class, 'index'])
        ->middleware(['auth'])
        ->name('adoptions.index'),

    Route::get('/adoptions/{id}', [AdoptionsController::class, 'show'])->name('adoptions.show'),

    Route::post('/adoptions', [AdoptionsController::class, 'store'])
        ->middleware(['auth'])
        ->name('adoptions.store'),

    Route::put('/adoptions/{adoption}', [AdoptionsController::class, 'update'])
        ->middleware(['auth'])
        ->name('adoptions.update'),

    Route::put('/adoptions/{adoption}/status', [AdoptionsController::class, 'updateStatus'])
        ->middleware(['auth'])
        ->name('adoptions.status-update'),
];
