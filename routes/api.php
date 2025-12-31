<?php

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
