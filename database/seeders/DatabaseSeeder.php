<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Notifications;
use App\Models\Permission;
use App\Models\PermissionVolunteer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Animal::factory(10)->create();
        Adoption::factory(10)->create();
        Notifications::factory(10)->create();
        $permissions = Permission::factory(10)->create();
        $volunteers = Volunteer::factory(10)->create();

        foreach ($volunteers as $volunteer) {
            $volunteer->permissions()->attach(
                $permissions->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
