<?php

declare(strict_types=1);

namespace App\Filament\Resources\ModeratorResource\Pages;

use App\Filament\Resources\ModeratorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModerators extends ListRecords
{
    protected static string $resource = ModeratorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
