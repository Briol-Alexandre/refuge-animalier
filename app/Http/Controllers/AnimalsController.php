<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Species;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimalsController extends Controller
{
    public function index()
    {
        $animals = Animal::with('breed')
            ->with('coat')
            ->with('specie')
            ->paginate(6);
        $breeds = Breed::all();
        $species = Species::all();
        $coats = Coat::all();
        $status = Status::values();

        return Inertia::render('Animals', [
            'animals' => $animals,
            'coats' => $coats,
            'breeds' => $breeds,
            'species' => $species,
            'status' => $status,
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
