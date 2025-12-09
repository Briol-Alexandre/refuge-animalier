<?php

use App\Models\Breed;
use App\Models\Species;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('creates a new breed with the transmitted values', function () {
    $species = Species::factory()->create();
    $breed = [
        'name' => 'Test',
        'specie_id' => $species->id,
    ];

    $this->post(route('breeds.store'), $breed);

    $this->assertDatabaseHas('breeds', [
        'name' => $breed['name'],
        'specie_id' => $breed['specie_id']
    ]);
});

