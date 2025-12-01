<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AnimalsController extends Controller
{
    public function index()
    {
        $animals = Animal::paginate(6);
        return Inertia::render('Animals', [
            'animals' => $animals
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
