<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Note;
use Illuminate\Http\Request;
use Psy\CodeCleaner\NoReturnValue;

class NotesController extends Controller
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
            'title' => 'string|min:3|max:30',
            'content' => 'string|min:3|max:255'
        ]);

        if ($request['animal_id']) {
            $animal = Animal::findOrFail($request['animal_id']);
            $note = $animal->notes()->create($validated);
        }

        if ($request['adoption_id']) {
            $adoption = Adoption::findOrFail($request['adoption_id']);
            $note = $adoption->notes()->create($validated);
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
            'title' => 'min:3|string',
            'content' => 'max:255|string'
        ]);
        $note = Note::findOrFail($id);
        $note->update($validated);
        $note->save();
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        $note->delete();

        return back();
    }
}
