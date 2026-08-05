<?php

namespace Database\Seeders;

use App\Models\Story;
use Cviebrock\EloquentTaggable\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
            'politics' => 'Politics',
            'entertainment' => 'Entertainment',
            'technology' => 'Technology',
            'national' => 'National',
            'elon-musk' => 'Elon Musk',
            'travel' => 'Travel',
            'space' => 'Space',
            'nova' => 'Nova',
            'jokes' => 'Jokes',
            'finance' => 'Finance',
            'walet' => 'Walet',
        ] as $normalized => $name) {
            Tag::query()->updateOrCreate(['normalized' => $normalized], [
                'name' => $name,
            ]);
        }

        $tags = Tag::all();

        foreach (Story::doesntHave('tags')->get() as $story) {
            $story->tags()->attach($tags->random());
        }
    }
}
