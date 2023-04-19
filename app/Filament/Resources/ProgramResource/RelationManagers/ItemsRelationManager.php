<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'topic.title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('started_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('ended_at')
                    ->required(),
                Forms\Components\Select::make('topic.title')
                    ->relationship('topic', 'title')
                    ->label('Topic')
                    ->options(
                        Topic::all()->pluck('title', 'id')
                        // fn () => \App\Models\Topic::query()
                        //     ->get()
                        //     ->mapWithKeys(fn ($topic) => [$topic->id => $topic->title])
                    )
                    ->searchable(),
                Forms\Components\Select::make('moderators.name')
                    ->relationship('moderators', 'name')
                    ->label('Moderator(s)')
                    ->options(
                        fn () => \App\Models\Moderator::query()
                            ->get()
                            ->mapWithKeys(fn ($moderator) => [$moderator->id => $moderator->name])
                    )
                    ->searchable()
                    ->multiple(),

                Forms\Components\TextInput::make('notes')
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic.title')
                    ->label('Topic')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('moderators.name')
                    ->label('Moderator(s)')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('started_at')
                    ->label('Start At')
                    ->dateTime('H:i:s d.m.Y')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ended_at')
                    ->label('End At')
                    ->dateTime('H:i:s d.m.Y')
                    ->searchable()
                    ->toggleable(
                        isToggledHiddenByDefault: true
                    )
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
