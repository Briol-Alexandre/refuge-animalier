<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\PermissionVolunteer;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PermissionVolunteerFactory extends Factory
{
    protected $model = PermissionVolunteer::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'volunteer_id' => Volunteer::factory(),
            'permission_id' => Permission::factory(),
        ];
    }
}
