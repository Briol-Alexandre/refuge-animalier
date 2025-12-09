<?php

use App\Models\Coat;
use App\Models\Species;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('creates a new coat with the transmitted values', function () {
    $coat = Coat::factory()->raw();

    $this->post(route('coat.store'), $coat);

    $this->assertDatabaseHas('coats', [
        'name' => $coat['name'],
    ]);
});

