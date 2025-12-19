<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\Status;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptionsController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::with('notes')->orderBy('adoption_date', 'asc')->paginate(10);
        $animals = Animal::all();
        $adopters = Adopter::all();
        $status = collect(AdoptionStatus::cases())->map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label()
        ]);
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
            'adoption_date' => 'nullable|date|date_format:Y-m-d',
            'status' => 'required',
            'note' => 'array',
            'note.*' => 'string',
        ]);

        $adoption = Adoption::create($validated);
        $animal = Animal::findOrFail($validated['animal_id']);
        $animal->update(
            [
                'status' => Status::IN_ADOPTION
            ]
        );

        $note = $request['note'];
        if ($note) {
            $adoption->notes()->create([
                'title' => $note['title'],
                'content' => $note['content'],
            ]);
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
            'animal_id' => 'exists:animals,id',
            'adopter_id' => 'exists:adopters,id',
            'adoption_date' => 'nullable|date',
            'status' => 'required',
        ]);

        $adoption = Adoption::findOrFail($id);

        $animal = Animal::findOrFail($adoption->animal_id);
        $animal->update(['status' => Status::AVAILABLE,]);

        $status = AdoptionStatus::fromLabel($validated['status']);
        $validated['status'] = $status;

        $adoption->update($validated);

        $animal = Animal::findOrFail($adoption->animal_id);
        $animal->update(['status' => Status::IN_ADOPTION,]);

        $adoption->save();
    }

    public function destroy($id)
    {
    }

    public function updateStatus(Adoption $adoption, Request $request)
    {
        $status = $request['status'];
        $adoption->update(array('status' => $status));
        $adoption->save();
        return back();
    }
}
