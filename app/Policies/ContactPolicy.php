<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;

class ContactPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('access_contact_form_messages');
    }

    public function view(User $user, Contact $contact): bool
    {
        return $user->can('access_contact_form_messages');
    }

    public function create(): bool
    {
        return false;
    }

    public function update(User $user, Contact $contact): bool
    {
        return $user->can('access_contact_form_messages');
    }

    public function delete(User $user, Contact $contact): bool
    {
        return $user->can('access_contact_form_messages');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('access_contact_form_messages');
    }
}
