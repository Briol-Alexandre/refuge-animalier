<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use Illuminate\Http\Request;

class BreedsController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|unique:breeds,name|min:3',
            'specie_id' => 'required|exists:species,id',
        ]);
        $breed = Breed::create($validated);

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
            'name' =>'required|min:2',
            'specie_id' => 'required|exists:species,id',
        ]);

        $breed = Breed::findOrFail($id);

        $breed->update($validated);

        $breed->save();

        return back();
    }

    public function destroy($id)
    {
        $breed = Breed::findOrFail($id);

        $breed->delete();

        return back();
    }
}
