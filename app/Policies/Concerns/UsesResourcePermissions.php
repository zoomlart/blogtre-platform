<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait UsesResourcePermissions
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_'.$this->permissionResource());
    }

    public function view(User $user, mixed $record = null): bool
    {
        return $user->can('read_'.$this->permissionResource());
    }

    public function create(User $user): bool
    {
        return $user->can('add_'.$this->permissionResource());
    }

    public function update(User $user, mixed $record = null): bool
    {
        return $user->can('edit_'.$this->permissionResource());
    }

    public function delete(User $user, mixed $record = null): bool
    {
        return $user->can('delete_'.$this->permissionResource());
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_'.$this->permissionResource());
    }

    public function restore(User $user, mixed $record = null): bool
    {
        return $user->can('edit_'.$this->permissionResource());
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('edit_'.$this->permissionResource());
    }

    public function forceDelete(User $user, mixed $record = null): bool
    {
        return $user->can('delete_'.$this->permissionResource());
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('delete_'.$this->permissionResource());
    }

    abstract protected function permissionResource(): string;
}
