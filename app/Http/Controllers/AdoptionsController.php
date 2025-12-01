<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptionsController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::paginate(10);
        return Inertia::render('Adoptions', ['adoptions' => $adoptions]);
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
