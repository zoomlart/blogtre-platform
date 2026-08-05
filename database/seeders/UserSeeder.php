<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::query()->updateOrCreate(['email' => 'admin@bianity.me'], [
            'name' => 'Bianity',
            'username' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('administrator');
        $admin->profile()->firstOrCreate([], Profile::factory()->make()->toArray());

        $moderator = User::query()->updateOrCreate(['email' => 'moder@bianity.me'], [
            'name' => 'Lord Moder',
            'username' => 'moder',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $moderator->assignRole('moderator');
        $moderator->profile()->firstOrCreate([], Profile::factory()->make()->toArray());

        $editor = User::query()->updateOrCreate(['email' => 'editor@bianity.me'], [
            'name' => 'Editor',
            'username' => 'editor',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
        ]);
        $editor->assignRole('editor');
        $editor->profile()->firstOrCreate([], Profile::factory()->make()->toArray());

        if (User::query()->count() < 8) {
            User::factory(5)->create()->each(function ($user) {
                $user->profile()->save(Profile::factory()->make());
                $user->assignRole('author');
            });
        }

        User::query()->doesntHave('profile')->get()->each(function (User $user) {
            $user->profile()->save(Profile::factory()->make());
        });
    }
}
