<?php

use App\Models\Species;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('creates a new specie with the transmitted values', function () {
    $specie = Species::factory()->raw();

    $this->post(route('species.store'), $specie);

    $this->assertDatabaseHas('species', [
        'name' => $specie['name'],
    ]);
});

