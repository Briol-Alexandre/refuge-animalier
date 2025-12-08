<?php

namespace Database\Factories;

use App\Enums\Sexe;
use App\Enums\Status;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;


    public function definition(): array
    {
        $arrayValues = ['male', 'female'];
        return [
            'name' => $this->faker->name(),
            'sexe' => $this->faker->randomElement(Sexe::values()),
            'age' => Carbon::now(),
            'desc' => $this->faker->sentence('40'),
            'status' => $this->faker->randomElement(Status::values()),
            'images' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'breed_id' => Breed::factory(),
        ];
    }
}
