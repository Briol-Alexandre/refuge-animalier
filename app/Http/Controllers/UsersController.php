<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::paginate(6)->load('permissions');
        $volunteers_link = Volunteer::paginate(6);
        $permissions =  Permission::all();
        return Inertia::render('Users', [
            'volunteers' => $volunteers,
            'permissions' => $permissions,
            'volunteers_link'=>$volunteers_link
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
