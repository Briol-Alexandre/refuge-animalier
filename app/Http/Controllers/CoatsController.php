<?php

namespace App\Http\Controllers;

use App\Models\Coat;
use Illuminate\Http\Request;

class CoatsController extends Controller
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
            'name' => 'unique:coats,name|min:3'
        ]);
        Coat::create($validated);
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
            'name' => 'min:3',
        ]);

        $coat = Coat::findOrFail($id);

        $coat->update($validated);

        $coat->save();

        return back();
    }

    public function destroy($id)
    {
        $coat = Coat::findOrFail($id);

        $coat->delete();

        return back();
    }
}
