<?php

namespace Database\Factories;

use App\Enums\NotificationType;
use App\Models\Notifications;
use App\Models\Animal;
use App\Models\Adoption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NotificationsFactory extends Factory
{
    protected $model = Notifications::class;

    public function definition(): array
    {
        $notifiableType = $this->faker->randomElement([
            Animal::class,
            Adoption::class,
            User::class,
        ]);

        $notifiable = $notifiableType::factory()->create();

        return [
            'title' => $this->faker->word(),
            'notifiable_type' => $notifiableType,
            'notifiable_id' => $notifiable->id,
            'read' => $this->faker->boolean(),
            'urgent' => $this->faker->boolean(),
            'type' => $this->faker->randomElement(NotificationType::values()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function forAnimal(?Animal $animal = null): static
    {
        return $this->state(fn (array $attributes) => [
            'notifiable_type' => Animal::class,
            'notifiable_id' => $animal?->id ?? Animal::factory()->create()->id,
        ]);
    }

    public function forAdoption(?Adoption $adoption = null): static
    {
        return $this->state(fn (array $attributes) => [
            'notifiable_type' => Adoption::class,
            'notifiable_id' => $adoption?->id ?? Adoption::factory()->create()->id,
        ]);
    }

    public function forUser(?User $user = null): static
    {
        return $this->state(fn (array $attributes) => [
            'notifiable_type' => User::class,
            'notifiable_id' => $user?->id ?? User::factory()->create()->id,
        ]);
    }
}
