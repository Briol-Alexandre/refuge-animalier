<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BreedFactory extends Factory
{
    protected $model = Breed::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'specie_id' => Species::factory(),
        ];
    }
}
