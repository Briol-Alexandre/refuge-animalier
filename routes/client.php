<?php
use Illuminate\Support\Facades\Route;

Route::domain('lespattesheureuses.test')->group(function () {
    Route::get('/', function () {
        return view('client.homepage');
    })->name('home.client');

    Route::get('/pattesheureuses', function () {
        return view('client.paws');
    })->name('paws.client');
    Route::get('/animals/{animal}', function (){
        return view('client.animals.show');
    })->name('animals.client.show');
    Route::get('/animals', function () {
        return view('client.animals');
    })->name('animals.client');
    Route::get('/contact', function (){
        return view('client.contact');
    })->name('contact.client');
});
