<?php

namespace App\Policies;

use App\Policies\Concerns\UsesResourcePermissions;

class PagePolicy
{
    use UsesResourcePermissions;

    protected function permissionResource(): string
    {
        return 'pages';
    }
}
