<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\User;
use App\Models\Volunteer;

class ClientController extends Controller
{
    public function index()
    {
        $animals = Animal::orderBy('created_at', 'desc')->take(4)->byStatus(Status::AVAILABLE)->get();
        $animals_count = Animal::count();
        $adoption_count = Adoption::count();
        $volunteer_count = User::count()-1;
        $available_count = Animal::byStatus(Status::AVAILABLE)->count();
        return view('client.homepage', compact('animals', 'animals_count', 'adoption_count', 'volunteer_count', 'available_count'));
    }
}
