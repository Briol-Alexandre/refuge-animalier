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
        $images = [
            'assets/img/dogs/dog1.png',
            'assets/img/dogs/dog2.png',
            'assets/img/dogs/dog3.png',
        ];
        $selectedImage = $this->faker->randomElement($images);
        $imageJson = [$selectedImage => []];

        return [
            'name' => $this->faker->name(),
            'breed_id' => Breed::factory(),
            'sexe' => $this->faker->randomElement(Sexe::values()),
            'age' => Carbon::now(),
            'desc' => $this->faker->sentence('20'),
            'status' => $this->faker->randomElement(Status::values()),
            'images' => json_encode($imageJson),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'updated_at' => Carbon::now(),
        ];
    }
}
