<?php

use App\Models\User;
use function Pest\Laravel\actingAs;


beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});


it('redirects to the dashboard page once a user is logged', function () {
    $user = User::factory()->create();

    actingAs($user);

    $response = $this->get(route('dashboard'));

    $response->assertStatus(200);

    $response->assertInertia(fn($page) => $page->component('Dashboard')
    );
});

it('refuses a unauthenticated user to access the dashboard but redirects to the login page', function () {

    auth()->logout();

    $response = $this->get(route('dashboard'));

    $response->assertStatus(302);

    $response->assertRedirect(route('login'));

});

it('loads the good components when using the nav', function () {
    $navLinks =
        [
            ['link' => route('dashboard'), 'component' => 'Dashboard'],
            ['link' => route('animals.index'), 'component' => 'Animals'],
            ['link' => route('adoptions.index'), 'component' => 'Adoptions'],
            ['link' => route('users.index'), 'component' => 'Users'],
            ['link' => route('notifications.index'), 'component' => 'Notifications'],
            ['link' => route('statistiques.index'), 'component' => 'Statistiques'],
        ];

    foreach ($navLinks as $link) {
        $response = $this->get($link['link']);
        $response->assertInertia(fn($page) => $page->component($link['component']));
    }

});

it('redirects unauthenticated users to login for each nav link', function () {

    auth()->logout();

    $navLinks = [
        route('dashboard'),
        route('animals.index'),
        route('adoptions.index'),
        route('users.index'),
        route('notifications.index'),
        route('statistiques.index'),
    ];

    foreach ($navLinks as $link) {
        $response = $this->get($link);
        $response->assertRedirect(route('login'));
    }
});
