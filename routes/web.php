<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::domain('lespattesheureuses.test')->group(function () {
    Route::get('/', function () {
        return view('client.homepage');
    })->name('home.client');

    Route::get('/pattesheureuses', function () {
        return view('client.paws');
    })->name('paws.client');
    Route::get('/animals', function () {
        return view('client.animals');
    })->name('animals.client');
});


Route::domain('admin.lespattesheureuses.test')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    })->name('home');

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__ . '/settings.php';
});


