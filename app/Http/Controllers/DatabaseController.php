<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Coat;
use App\Models\Species;
use App\Models\Vaccine;
use Inertia\Inertia;

class DatabaseController extends Controller
{
    public function index()
    {
        $species = Species::all();
        $breeds = Breed::all()->load('specie');
        $coats = Coat::all();
        $vaccines = Vaccine::all()->load('species');
        return Inertia::render('Database',
            [
                'species' => $species,
                'vaccines' => $vaccines,
                'breeds' => $breeds,
                'coats' => $coats
            ]
        );
    }
}
