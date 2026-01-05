<?php

namespace App\Http\Controllers;


use App\Mail\ContactMailOther;
use App\Mail\ContactMailVolunteer;
use App\Models\Demand;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\NoReturn;
use function Symfony\Component\String\b;

class ContactController extends Controller
{
    #[NoReturn]
    public function send(Request $request)
    {
        $validated = $request->validate([
            'last-name' => 'required',
            'first-name' => 'required',
            'email' => 'email|required',
            'tel' => 'required',
            'object' => 'required',
            'message' => 'nullable'
        ]);

        $fullName = $validated['first-name'] . ' ' . $validated['last-name'];

        $notificationTitleVolunteer = "{$fullName} veut devenir bénévole";

        $notificationTitleOther = "{$fullName} a une demande";

        if ($validated['object'] === 'volunteer') {
            Notifications::create(['title' => $notificationTitleVolunteer, 'urgent' => false, 'read' => false]);
            Mail::to('email@domain.com')->queue(new ContactMailVolunteer($validated));
        } else {
            $demand = Demand::create([
                'from' => $fullName,
                'email' => $validated['email'],
                'message' => $validated['message'],
            ]);
            $demand->notifications()->create([
                'title' => $notificationTitleOther,
                'urgent' => false,
                'read' => false
            ]);

            Mail::to('email@domain.com')->queue(new ContactMailOther($validated));

        }

        //TODO: faire en sorte que le mail s'envoie toujours à l'admin

        return back();
    }
}
