<?php

declare(strict_types=1);

namespace App\Filament\Resources\TopicResource\RelationManagers;

use App\Filament\Components\ViewRelationManager;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Filament\Resources\ModeratorResource;

class ModeratorsViewRelationManager extends ViewRelationManager
{
    protected static string $relationship = 'moderators';

    protected static ?string $recordTitleAttribute = 'name';

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
                ...ModeratorResource::getTable(),
            ])
            ->filters([
                // ..
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
