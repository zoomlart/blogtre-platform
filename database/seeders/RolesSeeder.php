<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::updateOrCreate(['name' => 'administrator', 'guard_name' => 'web'], [
            'name' => 'administrator',
            'guard_name' => 'web',
            'display_name' => 'Administrator',
            'description' => 'Site administrator with full access to admin panel.',
            'can_be_removed' => false,
        ]);

        Role::updateOrCreate(['name' => 'moderator', 'guard_name' => 'web'], [
            'name' => 'moderator',
            'guard_name' => 'web',
            'display_name' => 'Moderator',
            'description' => 'Site moderator can moderate comments (edit, delete), ban user and choose featured stories.',
            'can_be_removed' => false,
        ]);

        Role::updateOrCreate(['name' => 'editor', 'guard_name' => 'web'], [
            'name' => 'editor',
            'guard_name' => 'web',
            'display_name' => 'Editor',
            'description' => 'Editor can choose featured stories. The chosen story display on main page.',
            'can_be_removed' => false,
        ]);

        Role::updateOrCreate(['name' => 'author', 'guard_name' => 'web'], [
            'name' => 'author',
            'guard_name' => 'web',
            'display_name' => 'Author',
            'description' => 'Default role after register. Role with access on front site.',
            'can_be_removed' => false,
        ]);

        Role::updateOrCreate(['name' => 'user', 'guard_name' => 'web'], [
            'name' => 'user',
            'guard_name' => 'web',
            'display_name' => 'User',
            'description' => 'Role with access, only chatting in the comments.',
            'can_be_removed' => false,
        ]);

        Role::updateOrCreate(['name' => 'readonly', 'guard_name' => 'web'], [
            'name' => 'readonly',
            'guard_name' => 'web',
            'display_name' => 'User read-only',
            'description' => 'The user cannot create entries or comments',
            'can_be_removed' => false,
        ]);
    }
}
