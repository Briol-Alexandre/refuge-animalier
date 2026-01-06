<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\Status;
use App\Mail\AdoptionDemand;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Notifications;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function Termwind\render;

class ClientAnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::with('breed')->with('specie')->with('coat')->with('vaccines')->where('status', Status::AVAILABLE);
        $coats = Coat::all();
        $species = Species::all();
        $breeds = Breed::all();

        if ($request['specie']) {
            $query->whereHas('specie', function ($q) use ($request) {
                $q->where('species.id', $request->specie);
            });
        }

        if ($request['breed']) {
            $query->where('breed_id', $request['breed']);
        }

        if ($request['coat']) {
            $query->whereHas('coat', function ($q) use ($request) {
                $q->where('coats.id', $request->coat);
            });
        }

        if ($request['sexe']) {
            $query->where('sexe', $request['sexe']);
        }

        if ($request['search']) {
            $query->where('name', 'like', '%' . $request['search'] . '%');
        }

        $animals = $query->get();
        return view('client.animals', compact('animals', 'coats', 'breeds', 'species'));
    }

    public function show($id)
    {
        $animal = Animal::findOrFail($id);
        return view('client.animals.show', compact('animal'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'exists:animals,id',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'email|required',
            'tel' => 'required',
            'message' => 'nullable'
        ]);

        $fullName = $validated['first_name'] . ' ' . $validated['last_name'];

        $id = $validated['animal_id'];

        $adopter = Adopter::firstOrCreate([
            'name' => $fullName,
            'email' => $validated['email'],
            'tel' => $validated['tel']
        ]);

        $animal = Animal::findOrFail($id);

        $animal->update(['status' => Status::IN_ADOPTION]);

        $adoption = Adoption::create([
            'animal_id' => $animal->id,
            'adopter_id' => $adopter->id,
            'status' => AdoptionStatus::PENDING,
            'contact_message' => $validated['message']
        ]);

        $notificationTitle = "{$fullName} veut adopter {$animal->name}";

        $adoption->notifications()->create([
            'title' => $notificationTitle,
            'urgent' => false,
            'read' => false,
        ]);

        Mail::to('elise.poulain@gmail.com')->queue(new AdoptionDemand($validated, $animal));
        return redirect()
            ->route('animals.client.show', $animal->id);

    }


    public function filter(Request $request)
    {
        $specie = $request['specie'];
        $breed = $request['breed'];
        $coat = $request['coat'];
        $age = $request['age'];
        $sexe = $request['sexe'];
        $name = $request['search'];


    }
}
