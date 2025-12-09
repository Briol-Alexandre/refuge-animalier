<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Notifications;
use App\Models\Permission;
use App\Models\PermissionVolunteer;
use App\Models\Species;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vaccine;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Alexandre Briol',
            'email' => 'alexandre.briol@gmail.com',
        ]);

        $species = [
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

        $species_vaccines = [
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

        Adoption::factory(10)->create();
        Notifications::factory(10)->create();
        $permissions = Permission::factory(10)->create();
        $volunteers = Volunteer::factory(10)->create();

        $coats = collect();
        foreach ($coatNames as $coatName) {
            $coats->push(Coat::create([
                'name' => $coatName,
            ]));
        }

        $seedingBreeds = [];
        foreach ($species as $specie => $breeds) {
            $specie = Species::create([
                'name' => $specie
            ]);

            foreach ($breeds as $breed) {
                $breed = Breed::create([
                    'name' => $breed,
                    'specie_id' => $specie->id,
                ]);

                $seedingBreeds[] = $breed->id;
            }
        }

        $seedingVaccines = [];
        foreach ($species_vaccines as $species_vaccine => $vaccines) {
            $specie = Species::where('name', '=', $species_vaccine)->first();

            foreach ($vaccines as $vaccine) {
                $vaccine = Vaccine::create([
                    'name' => $vaccine,
                    'specie_id' => $specie->id,
                ]);
            }
        }

        for ($i = 0; $i < 20; $i++) {
            $animal = Animal::factory()->create([
                'breed_id' => $seedingBreeds[array_rand($seedingBreeds)],
            ]);


            $animal->coat()->attach(
                $coats->random(rand(1, 4))->pluck('id')->toArray()
            );

            //TODO: Ask how to link the vaccines to an animal
        }


        foreach ($volunteers as $volunteer) {
            $volunteer->permissions()->attach(
                $permissions->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
