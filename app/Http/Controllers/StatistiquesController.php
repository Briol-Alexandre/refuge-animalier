<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Notifications;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatistiquesController extends Controller
{
    public function index()
    {
        $animals = Animal::pluck('created_at');
        $animals_count = $animals->count();

        $available_animals = Animal::byStatus(Status::AVAILABLE)->pluck('created_at');
        $available_animals_count = $available_animals->count();

        $cure_animals = Animal::byStatus(Status::IN_CURE)->pluck('created_at');
        $cure_animals_count = $cure_animals->count();

        $adoptions = Animal::byStatus(Status::ADOPTED)->pluck('created_at');
        $adoptions_count = $adoptions->count();

        return Inertia::render('Statistiques',
            [
                'animals' => $animals_count,
                'available' => $available_animals_count,
                'cures' => $cure_animals_count,
                'adoptions' => $adoptions_count,
                'animal_model' => $animals,
                'available_model' => $available_animals,
                'cure_model' => $cure_animals,
                'adoption_model' => $adoptions,
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
        dd('test');
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
