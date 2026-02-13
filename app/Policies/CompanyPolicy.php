<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user !== null;
    }

    public function view(User $user, Company $company): bool
    {
        return $user !== null;
    }

    public function create(User $user): bool
    {
        return $user->isGlobalAdmin();
    }

    public function update(User $user, Company $company): bool
    {
        return $user->isGlobalAdmin();
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->isGlobalAdmin();
    }
}
