<?php

use App\Enums\Status;
use App\Http\Controllers\ClientAnimalController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Models\Animal;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/', [ClientController::class, 'index'])->name('home.client');

    Route::get('/pattesheureuses', function () {
        return view('client.paws');
    })->name('paws.client');
    Route::get('/animals/{id}', [ClientAnimalController::class, 'show'])
        ->name('animals.client.show');
    Route::get('/animals', [ClientAnimalController::class, 'index'])
        ->name('animals.client');
    Route::post('animals/', [ClientAnimalController::class, 'filter'])->name('animal-client.filter');
    Route::post('animals/{id}', [ClientAnimalController::class, 'send'])
        ->name('animals.client.demand');
    Route::get('/contact', function () {
        return view('client.contact');
    })->name('contact.client');
    Route::post('/contact', [ContactController::class, 'send'])
        ->name('contact.send');
});
