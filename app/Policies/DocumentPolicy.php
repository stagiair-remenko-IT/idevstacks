<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user !== null;
    }

    public function view(User $user, Document $document): bool
    {
        if ($user->isGlobalAdmin()) {
            return true;
        }

        if ($document->status === 'published') {
            return true;
        }

        return $document->created_by === $user->id;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, Document $document): bool
    {
        if ($user->isGlobalAdmin()) {
            return true;
        }

        return $document->created_by === $user->id;
    }

    public function delete(User $user, Document $document): bool
    {
        return $this->update($user, $document);
    }

    public function restore(User $user, Document $document): bool
    {
        return $user->isGlobalAdmin();
    }

    public function forceDelete(User $user, Document $document): bool
    {
        return $user->isGlobalAdmin();
    }
}

