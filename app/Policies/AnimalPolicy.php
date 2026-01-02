<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Animal $animal): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Animal $animal): bool
    {
        return $user->role === 'Admin';
    }

    public function delete(User $user, Animal $animal): bool
    {
        return $user->role === 'Admin';
    }

    public function restore(User $user, Animal $animal): bool
    {
        return true;
    }

    public function forceDelete(User $user, Animal $animal): bool
    {
        return true;
    }
}
