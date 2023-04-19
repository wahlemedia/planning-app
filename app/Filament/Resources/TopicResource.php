<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TopicResource\Pages;
use App\Filament\Resources\TopicResource\RelationManagers\ModeratorsRelationManager;
use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Tables\Columns\SpatieTagsColumn;
use Spatie\Tags\Tag;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $slug = 'program/topics';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getForm());
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.program');
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ModeratorsRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTable(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),
            SpatieTagsColumn::make('tags')->type('topics')
                ->searchable()
                ->toggleable()
                ->sortable(),
            Tables\Columns\TextColumn::make('moderators_count')
                ->counts('moderators')
                ->searchable()
                ->toggleable()
                ->sortable(),
        ];
    }

    public static function getForm(): array
    {
        return [

            Forms\Components\Card::make()
                ->schema(
                    [
                        Forms\Components\TextInput::make('title')
                            ->autofocus()
                            ->required()
                            ->placeholder('Title'),
                        SpatieTagsInput::make('tags')->suggestions(
                            Tag::withType('topics')->pluck('name')->toArray()
                        )->type('topics'),
                        Forms\Components\Textarea::make('description')
                            ->placeholder('Description')
                            ->columnSpan('full')
                            ->rows(5),
                    ]
                )->columns(2),

            Forms\Components\Section::make('Additional Resources')
                ->description('Add additional resources about this topic')
                ->schema([
                    Forms\Components\Repeater::make('links')
                        ->schema([
                            Forms\Components\TextInput::make('url')->required()
                                ->columnSpan(2)
                                ->prefix('https://'),
                            Forms\Components\TextInput::make('name')
                                ->columnSpan(2),
                            Forms\Components\Select::make('target')
                                ->options([
                                    '_self' => 'Same window',
                                    '_blank' => 'New window',
                                ])
                                ->default('_blank')
                                ->required(),
                        ])
                        ->createItemButtonLabel('Add Link')
                        ->columns(5)
                        ->columnSpan('full'),
                    SpatieMediaLibraryFileUpload::make('attachments')
                        ->multiple()
                        ->columnSpan('full')
                        ->enableReordering(),
                ])
        ];
    }
}
