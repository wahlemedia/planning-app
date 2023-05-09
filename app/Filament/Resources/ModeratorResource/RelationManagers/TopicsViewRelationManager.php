<?php

declare(strict_types=1);

namespace App\Filament\Resources\ModeratorResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Filament\Resources\TopicResource;
use App\Filament\Components\ViewRelationManager;

class TopicsViewRelationManager extends ViewRelationManager
{
    protected static string $relationship = 'topics';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //..
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ...TopicResource::getTable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ..
            ])
            ->actions([
                // ..
            ])
            ->bulkActions([
                // ..
            ]);
    }
}
