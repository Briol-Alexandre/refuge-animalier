<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        $available_animals = Animal::where('status', '=', 'available');
        $cure_animals = Animal::where('status', '=', 'cure');
        $adoptions = Adoption::where('status' ,'=', 'adopted');
        $volunteers = Volunteer::all();
        return Inertia::render('Dashboard',
            [
                'animals' => $animals,
                'availables' =>$available_animals,
                'cures' =>$cure_animals,
                'adoptions' => $adoptions,
                'volunteers' => $volunteers
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
