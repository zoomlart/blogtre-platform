<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_users');
    }

    public function view(User $user, User $subject): bool
    {
        return $user->can('read_users') || $user->is($subject);
    }

    public function create(User $user): bool
    {
        return $user->can('add_users');
    }

    public function update(User $user, User $subject): bool
    {
        return $user->can('edit_users') && ! $subject->isAdmin();
    }

    public function ban(User $user, User $subject): bool
    {
        return ($user->isAdmin() && ! $subject->isAdmin()) ||
            ($user->isModerator() && ! $subject->isAdmin() && ! $subject->isModerator());
    }

    public function delete(User $user, User $subject): bool
    {
        return ($user->isAdmin() || $user->is($subject)) && ! $subject->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_users');
    }

    public function restore(User $user, User $subject): bool
    {
        return $user->can('edit_users') && ! $subject->isAdmin();
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('edit_users');
    }

    public function forceDelete(User $user, User $subject): bool
    {
        return $user->can('delete_users') && ! $subject->isAdmin();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_users');
    }
}
