<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isGlobalAdmin();
    }

    public function view(User $user, User $subject): bool
    {
        return $user->isGlobalAdmin() || $user->id === $subject->id;
    }

    public function create(User $user): bool
    {
        return $user->isGlobalAdmin();
    }

    public function update(User $user, User $subject): bool
    {
        return $user->isGlobalAdmin() && $user->id !== $subject->id;
    }

    public function delete(User $user, User $subject): bool
    {
        return $user->isGlobalAdmin() && $user->id !== $subject->id;
    }
}

