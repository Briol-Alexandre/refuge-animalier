<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccinesController extends Controller
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
            'name'   => 'required|unique:breeds,name|min:5',
            'specie_id' => 'required|exists:species,id',
        ]);
        $vaccine = Vaccine::create($validated);

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
            'name' =>'required|min:5',
            'specie_id' => 'required|exists:species,id',
        ]);

        $vaccine = Vaccine::findOrFail($id);

        $vaccine->update($validated);

        $vaccine->save();

        return back();
    }

    public function destroy($id)
    {
        $vaccine = Vaccine::findOrFail($id);

        $vaccine->delete();

        return back();
    }
}
