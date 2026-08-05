<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            'news' => 'News',
            'lifestyle' => 'Lifestyle',
            'fashion' => 'Fashion',
            'politics' => 'Politics',
            'world' => 'World',
            'sports' => 'Sports',
            'business' => 'Business',
            'gadgets' => 'Gadgets',
            'showbiz' => 'Showbiz',
            'crypto' => 'Crypto',
        ] as $slug => $name) {
            Community::query()->updateOrCreate(['slug' => $slug], [
                'user_id' => 1,
                'name' => $name,
                'description' => "The description of {$slug} community",
            ]);
        }
    }
}
