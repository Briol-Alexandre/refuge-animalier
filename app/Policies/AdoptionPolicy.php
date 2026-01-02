<?php

namespace App\Policies;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdoptionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Adoption $adoption): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Adoption $adoption): bool
    {
        return $user->role === 'Admin';
    }

    public function delete(User $user, Adoption $adoption): bool
    {
        return $user->role === 'Admin';
    }

    public function restore(User $user, Adoption $adoption): bool
    {
        return true;
    }

    public function forceDelete(User $user, Adoption $adoption): bool
    {
        return true;
    }
}
