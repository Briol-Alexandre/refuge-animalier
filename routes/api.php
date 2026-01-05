<?php

use App\Models\Demand;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Adoption;
use App\Models\Animal;

Route::get('/animals/{id}', function ($id) {
    return Animal::with(['breed', 'coat', 'specie', 'vaccines', 'notes'])
        ->findOrFail($id);
});

Route::get('/adoptions/{id}', function ($id) {
    return [
        $adoption = Adoption::with(['notes', 'adopter'])
            ->findOrFail($id),
        Animal::with('specie', 'breed')->find($adoption->animal_id)];

});

Route::get('/users/{id}', function ($id) {
    return
        User::with('permissions')
            ->findOrFail($id);
});

Route::get('/demands/{id}', function ($id) {
    return
        Demand::findOrFail($id);
});
