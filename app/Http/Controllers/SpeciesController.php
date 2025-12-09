<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'unique:species'
        ]);
        $specie = Species::create($validated);

        return back();

    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'=>'min:3',
        ]);

        $specie = Species::findOrFail($id);

        $specie->update($validated);

        $specie->save();

        return back();
    }

    public function destroy($id)
    {
        $specie = Species::findOrFail($id);

        $specie->delete();

        return back();
    }
}
