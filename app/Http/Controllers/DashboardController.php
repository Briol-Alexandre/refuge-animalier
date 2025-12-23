<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Notifications;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $animals = Animal::count();
        $available_animals = Animal::byStatus(Status::AVAILABLE)->count();
        $cure_animals = Animal::byStatus(Status::IN_CURE)->count();
        $adoptions = Animal::byStatus(Status::IN_ADOPTION)->count();

        $volunteers = User::count();
        $notifications = Notifications::where('urgent', false)->where('read', false)->get();
        $urgents = Notifications::where('urgent', true)->where('read', false)->get();
        return Inertia::render('Dashboard',
            [
                'title' => 'Dashboard',
                'animals' => $animals,
                'available' => $available_animals,
                'cures' => $cure_animals,
                'adoptions' => $adoptions,
                'volunteers' => $volunteers,
                'notifications' => $notifications,
                'urgents' => $urgents,
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
