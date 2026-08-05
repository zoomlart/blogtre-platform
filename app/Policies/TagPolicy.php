<?php

namespace App\Policies;

use App\Policies\Concerns\UsesResourcePermissions;

class TagPolicy
{
    use UsesResourcePermissions;

    protected function permissionResource(): string
    {
        return 'tags';
    }
}
