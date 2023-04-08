<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TopicResource\Pages;
use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
            'index' => Pages\ManageTopics::route('/'),
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
        ];
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->autofocus()
                ->required()
                ->placeholder('Title')
                ->columnSpan('full')
                ->rule('unique:topics,title'),
            Forms\Components\Textarea::make('description')
                ->placeholder('Description')
                ->columnSpan('full')
                ->rows(5),
            SpatieMediaLibraryFileUpload::make('attachments')
                ->multiple()
                ->collection('files')
                ->enableReordering(),
        ];
    }
}
