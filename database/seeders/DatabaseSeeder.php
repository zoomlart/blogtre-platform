<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            CommunitySeeder::class,
            PageSeeder::class,
            TagSeeder::class,
        ]);

        if (filter_var(env('DEMO_MODE', false), FILTER_VALIDATE_BOOLEAN)) {
            $this->call([
                StorySeeder::class,
            ]);
        }
    }
}
