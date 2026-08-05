<?php

namespace App\Policies;

use App\Models\Story;
use App\Models\User;

class StoryPolicy
{
    public function viewAny(User $user)
    {
        return $user->can('view_stories');
    }

    public function view(User $user, Story $story)
    {
        return $user->can('read_stories') || $user->id === (int) $story->user_id;
    }

    public function create(User $user)
    {
        return $user->can('add_stories');
    }

    public function update(User $user, Story $story)
    {
        if ($user->can('edit_stories')) {
            return $user->id === (int) $story->user_id || $user->isAdmin();
        }
    }

    public function pin(User $user, Story $story)
    {
        if ($user->can('edit_stories') ?? $story->isPublished()) {
            return $user->id === (int) $story->user_id;
        }
    }

    public function delete(User $user, Story $story)
    {
        if ($user->can('delete_stories')) {
            return $user->id === (int) $story->user_id || $user->isAdmin();
        }
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Story $story): bool
    {
        return $user->isAdmin();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Story $story): bool
    {
        return $user->isAdmin();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}
