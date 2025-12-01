<?php

use App\Http\Controllers\AdoptionsController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::domain('admin.lespattesheureuses.test')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return Inertia::render('auth/Login', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    })->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');


    Route::get('/animals', [AnimalsController::class, 'index'])
        ->middleware(['auth'])
        ->name('animals.index');

    Route::get('/adoptions', [AdoptionsController::class, 'index'])
        ->middleware(['auth'])
        ->name('adoptions.index');

    Route::get('/users', [UsersController::class, 'index'])
        ->middleware(['auth'])
        ->name('users.index');

    Route::get('/notifications', [NotificationsController::class, 'index'])
        ->middleware(['auth'])
        ->name('notifications.index');

    Route::get('/statistiques', [StatistiquesController::class, 'index'])
        ->middleware(['auth'])
        ->name('statistiques.index');

    Route::get('/statistiques/{statistique}', [StatistiquesController::class, 'show'])
        ->middleware(['auth'])
        ->name('statistiques.show');


    require __DIR__ . '/settings.php';
});
