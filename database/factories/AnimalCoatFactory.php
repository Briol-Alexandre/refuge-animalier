<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\AnimalCoat;
use App\Models\Coat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalCoatFactory extends Factory
{
    protected $model = AnimalCoat::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'animal_id' => Animal::factory(),
            'coat_id' => Coat::factory(),
        ];
    }
}
