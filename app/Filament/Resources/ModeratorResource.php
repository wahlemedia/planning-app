<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ModeratorResource\Pages;
use App\Filament\Resources\ModeratorResource\RelationManagers\TopicsRelationManager;
use App\Models\Moderator;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModeratorResource extends Resource
{
    protected static ?string $model = Moderator::class;

    protected static ?string $slug = 'program/moderators';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';


    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.program');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Forms\Components\Card::make()
                    ->schema(
                        static::getForm()
                    )->columns(2)
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getTable())
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //  TopicsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModerators::route('/'),
            'create' => Pages\CreateModerator::route('/create'),
            'edit' => Pages\EditModerator::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email(),
            Forms\Components\RichEditor::make('notes')
                ->placeholder('Notes about this moderator')
                ->disableToolbarButtons([
                    'attachFiles',
                    'codeBlock',
                ])
                ->columnSpan('full')
        ];
    }

    public static function getTable(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable()
                ->sortable(),
            // Tables\Columns\TextColumn::make('topics_count')
            //     ->counts('topics')
            //     ->searchable()
            //     ->sortable(),

        ];
    }
}
