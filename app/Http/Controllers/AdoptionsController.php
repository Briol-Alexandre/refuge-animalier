<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptionsController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::paginate(10);
        $animals = Animal::all();
        $adopters = Adopter::all();
        $status = AdoptionStatus::cases();
        return Inertia::render('Adoptions',
            [
                'title' => 'Liste des adoptions',
                'adoptions' => $adoptions,
                'animals' => $animals,
                'adopters' => $adopters,
                'status' => $status
            ]
        );
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if ($request['animal_id']) {
            $request['animal_id'] = $request['animal_id']['id'];
        }
        if ($request['adopter_id']) {
            $request['adopter_id'] = $request['adopter_id']['id'];
        }
        $validated = $request->validate([
            'animal_id' => 'exists:animals,id',
            'adopter_id' => 'exists:adopters,id',
            'adoption_date' => 'nullable|date',
            'status' => 'required',
        ]);

        Adoption::create($validated);

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
    }

    public function destroy($id)
    {
    }
}
