<?php

namespace App\Filament\Resources\TopicResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ModeratorResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ModeratorsRelationManager extends RelationManager
{
    protected static string $relationship = 'moderators';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ...ModeratorResource::getTable(),
                Tables\Columns\TextColumn::make('pivot.held_at')
                    ->label('Held At')
                    ->dateTime('H:i:s d.m.Y')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\DateTimePicker::make('held_at')
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
