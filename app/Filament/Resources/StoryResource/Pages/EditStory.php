<?php

namespace App\Filament\Resources\StoryResource\Pages;

use App\Filament\Resources\StoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditStory extends EditRecord
{
    protected static string $resource = StoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
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
