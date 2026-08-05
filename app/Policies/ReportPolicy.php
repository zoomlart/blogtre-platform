<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\UsesResourcePermissions;

class ReportPolicy
{
    use UsesResourcePermissions;

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return false;
    }

    protected function permissionResource(): string
    {
        return 'reports';
    }
}
