<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Notifications;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function index()
    {
        $urgents = Notifications::where('urgent', true)->orderBy("created_at", 'desc')->with('notifiable')->get();
        $notifications = Notifications::where('urgent', false)->orderBy("created_at", 'desc')->with('notifiable')->get();
        $status = collect(Status::cases())->map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label()
        ]);
        return Inertia::render('Notifications',
            [
                'title' => 'Notifications',
                'notifications' => $notifications,
                'urgents' => $urgents,
                'status' => $status
            ]
        );
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

    public function update(Request $request, Notifications $notification)
    {
        $validated = $request->validate([
            'read' => 'required|boolean',
            'urgent' => 'required|boolean'
        ]);


        $notification->update([
            'read' => $validated['read'],
            'urgent' =>  $validated['urgent']
        ]);
        return back();
    }


    public function destroy(Notifications $notification)
    {
        $notification->delete();
        return back();
    }
}
