<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_comments');
    }

    public function view(User $user, Comment $comment): bool
    {
        return $user->can('read_comments') || $user->id === $comment->user_id;
    }

    public function create(User $user): bool
    {
        return $user->can('add_comments');
    }

    public function update(User $user, Comment $comment)
    {
        if ($user->can('edit_comments')) {
            return $user->id === $comment->user_id || $user->isAdmin() || $user->isModerator();
        }
    }

    public function delete(User $user, Comment $comment)
    {
        if ($user->can('delete_comments')) {
            return $user->id === $comment->user_id || $user->isAdmin() || $user->isModerator();
        }
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function restoreAny(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin() || $user->isModerator();
    }
}
