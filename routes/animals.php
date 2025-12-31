<?php

use App\Http\Controllers\AnimalsController;
use App\Models\Animal;

return [
    Route::get('/animals', [AnimalsController::class, 'index'])
        ->middleware(['auth'])
        ->name('animals.index'),

    Route::post('/animals', [AnimalsController::class, 'store'])
        ->middleware(['auth'])
        ->name('animals.store'),

    Route::post('/animals/{animal}', [AnimalsController::class, 'update'])
        ->middleware(['auth'])
        ->name('animals.update'),

    Route::put('/animals/{animal}/status', [AnimalsController::class, 'updateStatus'])
        ->middleware(['auth'])
        ->name('animals.status-update'),

    Route::delete('/animals/{animal}', [AnimalsController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('animals.destroy'),

    Route::get('/api/animals/{id}', function ($id) {
        return Animal::with(['breed', 'coat', 'specie', 'vaccines', 'notes'])
            ->find($id);
    }),

];
