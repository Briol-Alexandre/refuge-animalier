<?php

use App\Enums\Status;
use App\Http\Controllers\AdoptionsController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\BreedsController;
use App\Http\Controllers\CoatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VaccinesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::domain('admin'. config('app.domain'))->middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'))->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');


    include 'animals.php';

    Route::post('/notes', [NotesController::class, 'store'])
        ->middleware(['auth'])
        ->name('notes.store');

    Route::put('/notes/{note}', [NotesController::class, 'update'])
        ->middleware(['auth'])
        ->name('notes.update');

    Route::delete('/notes/{note}', [NotesController::class, 'destroy'])
        ->middleware('auth')
        ->name('notes.destroy');


    Route::get('/adoptions', [AdoptionsController::class, 'index'])
        ->middleware(['auth'])
        ->name('adoptions.index');

    Route::post('/adoption', [AdoptionsController::class, 'store'])
        ->middleware(['auth'])
        ->name('adoptions.store');

    Route::put('/adoptions/{adoption}', [AdoptionsController::class, 'update'])
        ->middleware(['auth'])
        ->name('adoptions.update');

    Route::put('/adoptions/{adoption}/status', [AdoptionsController::class, 'updateStatus'])
        ->middleware(['auth'])
        ->name('adoptions.status-update');

    Route::get('/users', [UsersController::class, 'index'])
        ->middleware(['auth'])
        ->name('users.index');

    Route::post('/users', [UsersController::class, 'store'])
        ->middleware(['auth'])
        ->name('users.store');

    Route::post('/users/{user}', [UsersController::class, 'update'])
        ->middleware(['auth'])
        ->name('users.update');

    Route::delete('users/{user}', [UsersController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('users.destroy');

    Route::get('/notifications', [NotificationsController::class, 'index'])
        ->middleware(['auth'])
        ->name('notifications.index');

    Route::get('/database', [DatabaseController::class, 'index'])
        ->middleware(['auth'])
        ->name('database.index');

    Route::put('/notifications/{notification}', [NotificationsController::class, 'update'])
        ->middleware('auth')
        ->name('notifications.update');

    Route::delete('/notifications/{notification}', [NotificationsController::class, 'destroy'])
        ->middleware('auth')
        ->name('notifications.destroy');

    Route::get('/statistiques', [StatistiquesController::class, 'index'])
        ->middleware(['auth'])
        ->name('statistiques.index');

    Route::get('/statistiques/{statistique}', [StatistiquesController::class, 'show'])
        ->middleware(['auth'])
        ->name('statistiques.show');

    Route::post('/species', [SpeciesController::class, 'store'])
        ->middleware(['auth'])
        ->name('species.store');

    Route::patch('/species/{specie}', [SpeciesController::class, 'update'])
        ->middleware(['auth'])
        ->name('species.update');

    Route::delete('/species/{specie}', [SpeciesController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('species.destroy');

    Route::post('/breeds', [BreedsController::class, 'store'])
        ->middleware(['auth'])
        ->name('breeds.store');

    Route::patch('/breeds/{breed}', [BreedsController::class, 'update'])
        ->middleware(['auth'])
        ->name('breeds.update');

    Route::delete('/breeds/{breed}', [BreedsController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('breeds.destroy');


    Route::post('/coats', [CoatsController::class, 'store'])
        ->middleware(['auth'])
        ->name('coat.store');

    Route::patch('/coats/{coat}', [CoatsController::class, 'update'])
        ->middleware(['auth'])
        ->name('coats.update');

    Route::delete('/coats/{coat}', [CoatsController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('coats.destroy');

    Route::post('/vaccines', [VaccinesController::class, 'store'])
        ->middleware(['auth'])
        ->name('vaccine.store');

    Route::patch('/vaccines/{vaccine}', [VaccinesController::class, 'update'])
        ->middleware(['auth'])
        ->name('vaccines.update');

    Route::delete('/vaccines/{vaccine}', [VaccinesController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('vaccines.destroy');

    Route::post('/statistiques/export', [StatistiquesController::class, 'exportPDF'])
        ->middleware(['auth'])
        ->name('export-pdf');


    require __DIR__ . '/settings.php';
});
