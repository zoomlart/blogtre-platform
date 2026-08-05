<?php

namespace App\Filament\Resources\StoryResource\Pages;

use App\Filament\Resources\StoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateStory extends CreateRecord
{
    protected static string $resource = StoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $body = $data['body_rendered'] ?? '';

        $data['body'] = json_encode([
            'time' => now()->timestamp,
            'blocks' => [
                [
                    'type' => 'paragraph',
                    'data' => [
                        'text' => $body,
                    ],
                ],
            ],
        ]);

        if (blank($data['summary'] ?? null)) {
            $data['summary'] = Str::limit(strip_tags($body), 250);
        }

        if (! blank($data['approved_at'] ?? null) && blank($data['published_at'] ?? null)) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
