<?php

namespace Database\Factories;

use App\Enums\AdoptionStatus;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'adoption_date' => Carbon::now(),
            'status' => $this->faker->randomElement(AdoptionStatus::values()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'animal_id' => Animal::inRandomOrder()->first()?->id ?? Animal::factory(),
            'adopter_id' => Adopter::factory(),
        ];
    }
}
