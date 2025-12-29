<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\Status;
use App\Mail\AdoptionDemand;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function Termwind\render;

class ClientAnimalController extends Controller
{
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

        $fullName = $validated['first_name'] . $validated['last_name'];

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

        Notifications::create(['title' => $notificationTitle, 'urgent' => false, 'read' => false]);




        Mail::to('email@domain.com')->send(new AdoptionDemand($validated, $animal));
        return redirect()
            ->route('animals.client.show', $animal->id);

    }

    public function index()
    {
        $animals = Animal::with('breed')->with('specie')->with('coat')->with('vaccines')->where('status', Status::AVAILABLE)->get();
        return view('client.animals', compact('animals'));
    }

    public function show($id) {
        $animal = Animal::findOrFail($id);
        return view('client.animals.show', compact('animal'));
    }
}
