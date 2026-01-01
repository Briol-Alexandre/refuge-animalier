<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Adopter;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Notifications;
use App\Models\Permission;
use App\Models\Species;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Alexandre Briol',
            'email' => 'alexandre.briol@gmail.com',
        ]);

        $speciesData = [
            'Dog' => [
                'Husky',
                'Chihuahua',
                'Golden Retriever',
                'Berger Australien',
                'Cocker'
            ],
            'Cat' => [
                'Persan',
                'Siamois',
                'Maine Coon',
                'Sphinx'
            ],
        ];

        $speciesVaccines = [
            'Dog' => [
                'CHPPi',
                'Rage',
                'Toux du chenil',
            ],
            'Cat' => [
                'Typhus',
                'Coryza',
                'Leucose féline'
            ]
        ];

        $coatNames = [
            'Blanc',
            'Noir',
            'Doré',
            'Tâché',
            'Tricolore',
            'Brun',
        ];

        $coats = collect();
        foreach ($coatNames as $coatName) {
            $coats->push(Coat::create([
                'name' => $coatName,
            ]));
        }

        foreach ($speciesData as $specieName => $breedNames) {
            $speciesModel = Species::create([
                'name' => $specieName
            ]);

            foreach ($breedNames as $breedName) {
                Breed::create([
                    'name' => $breedName,
                    'specie_id' => $speciesModel->id,
                ]);
            }
        }

        foreach ($speciesVaccines as $specieName => $vaccineNames) {
            $speciesModel = Species::where('name', $specieName)->first();

            foreach ($vaccineNames as $vaccineName) {
                Vaccine::create([
                    'name' => $vaccineName,
                    'specie_id' => $speciesModel->id,
                ]);
            }
        }

        $permissions = Permission::factory(10)->create();
        $users = User::factory(20)->create();

        foreach ($users as $user) {
            $user->permissions()->attach(
                $permissions->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        $adopters = Adopter::factory(30)->create();

        $animals = collect();
        for ($i = 0; $i < 30; $i++) {
            $animal = Animal::factory()->create([
                'breed_id' => Breed::inRandomOrder()->first()->id,
            ]);

            $animal->coat()->attach(
                $coats->random(rand(1, 4))->pluck('id')->toArray()
            );

            $compatibleVaccines = $animal->breed->specie->vaccine;

            if ($compatibleVaccines->count() > 0) {
                $animal->vaccines()->attach(
                    $compatibleVaccines
                        ->random(rand(0, $compatibleVaccines->count()))
                        ->pluck('id')
                        ->toArray()
                );
            }

            $animals->push($animal);
        }

        for ($i = 0; $i < 10; $i++) {
            Adoption::factory()->create([
                'animal_id' => $animals->random()->id,
                'adopter_id' => $adopters->random()->id,
            ]);
        }

        foreach ($animals->random(10) as $animal) {
            Notifications::factory()->forAnimal($animal)->create();
        }

        $adoptions = Adoption::all();
        foreach ($adoptions->random(min(5, $adoptions->count())) as $adoption) {
            Notifications::factory()->forAdoption($adoption)->create();
        }

        foreach ($users->random(5) as $user) {
            Notifications::factory()->forUser($user)->create();
        }
    }
}
