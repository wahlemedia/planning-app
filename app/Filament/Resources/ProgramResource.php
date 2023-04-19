<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Program;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\ProgramStateEnum;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProgramResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProgramResource\RelationManagers\ItemsRelationManager;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $slug = 'program/program';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 1;

    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.program');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Card::make()
                                ->schema(
                                    static::getForm()
                                )->columns(2)
                        ])->columnSpan(2),
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('State')
                                ->schema([

                                    Forms\Components\Select::make('state')
                                        ->options(ProgramStateEnum::toArray())
                                        ->default(ProgramStateEnum::DRAFT)
                                        ->required()
                                        ->placeholder('Select a state...'),
                                ]),
                        ]),
                ]
            )->columns(3);
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
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
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
            Tables\Columns\BadgeColumn::make('state')
                ->colors(colors: [
                    'secondary' => 'draft',
                    'warning' => 'reviewing',
                    'success' => 'published',
                ])
        ];
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->autofocus()
                ->required()
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state, $context) {
                    if ($context === 'edit') {
                        return;
                    }

                    $set('slug', Str::slug($state));
                })
                ->placeholder('Title'),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->rules(['alpha_dash'])
                ->unique(table: Program::class, column: 'slug', ignoreRecord: true)
                ->placeholder('Slug'),

            Forms\Components\RichEditor::make('description')
                ->placeholder('Description ...')
                ->disableToolbarButtons([
                    'attachFiles',
                    'codeBlock',
                ])
                ->columnSpan('full')
        ];
    }
}
