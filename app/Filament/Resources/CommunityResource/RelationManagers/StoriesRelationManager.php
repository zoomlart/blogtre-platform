<?php

namespace App\Filament\Resources\CommunityResource\RelationManagers;

use App\Filament\Resources\StoryResource;
use App\Models\Story;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class StoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'stories';

    public function form(Form $form): Form
    {
        return StoryResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('author.username')
                    ->label(__('Author'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Status'))
                    ->badge()
                    ->getStateUsing(fn (Story $record): string => $record->published_at?->isPast() ? __('Published') : __('Draft'))
                    ->colors([
                        'success' => __('Published'),
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label(__('Approved'))
                    ->badge()
                    ->getStateUsing(fn (Story $record): string => $record->approved_at ? __('Approved') : __('Pending'))
                    ->colors([
                        'success' => __('Approved'),
                        'warning' => __('Pending'),
                    ]),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label(__('Status'))
                    ->trueLabel(__('Published'))
                    ->falseLabel(__('Draft'))
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('published_at'),
                        false: fn (Builder $query) => $query->whereNull('published_at'),
                        blank: fn (Builder $query) => $query,
                    ),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->prepareStoryData($data)),
            ])
            ->actions([
                Action::make('approve')
                    ->label(__('Approve'))
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Story $record): bool => $record->approved_at === null)
                    ->requiresConfirmation()
                    ->action(function (Story $record): void {
                        $record->forceFill([
                            'approved_at' => now(),
                            'published_at' => $record->published_at ?? now(),
                        ])->save();
                    }),
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => $this->prepareStoryData($data)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    private function prepareStoryData(array $data): array
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
