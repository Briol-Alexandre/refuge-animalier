<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Species;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimalsController extends Controller
{
    public function index()
    {
        $animals = Animal::with('breed')
            ->with('coat')
            ->with('specie')
            ->with('vaccines')
            ->paginate(6);
        $breeds = Breed::all();
        $species = Species::all();
        $coats = Coat::all();
        $status = Status::values();
        $vaccines = Vaccine::all();
        return Inertia::render('Animals', [
            'animals' => $animals,
            'coats' => $coats,
            'breeds' => $breeds,
            'species' => $species,
            'status' => $status,
            'vaccines' => $vaccines
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'sexe' => 'required',
            'age' => 'required',
            'desc' => 'max:255',
            'status' => 'required',
            'images' => 'file:png|nullable',
        ]);

        $coats = $request['coat_id'];


        $vaccines = $request['vaccines'];


        $animal = Animal::create($validated);
        if ($vaccines) {
            foreach ($vaccines as $vaccine) {
                $animal->vaccines()->attach($vaccine);
            }
        }
        if ($coats) {
            foreach ($coats as $coat) {
                $animal->coat()->attach($coat);
            }
        }

        return back();

    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'sexe' => 'required',
            'age' => 'required',
            'desc' => 'max:255',
            'status' => 'required',
            'images' => 'file:png|nullable',
        ]);

        $animal = Animal::findOrFail($id);

        $animal->update($validated);

        $coats = $request['coat_id'];
        $vaccines = $request['vaccines'];

        if ($vaccines) {
            foreach ($vaccines as $vaccine) {
                $animal->vaccines()->sync($vaccine);
            }
        }
        if ($coats) {
            foreach ($coats as $coat) {
                $animal->coat()->sync($coat);
            }
        }

        return back();

    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);

        $animal->delete();
    }

    public function updateStatus(Animal $animal, Request $request)
    {
        $status = $request['status'];
        $animal->update(array('status' => $status));
        $animal->save();
        return back();
    }
}
