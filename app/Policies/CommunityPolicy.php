<?php

namespace App\Policies;

use App\Policies\Concerns\UsesResourcePermissions;

class CommunityPolicy
{
    use UsesResourcePermissions;

    protected function permissionResource(): string
    {
        return 'communities';
    }
}
