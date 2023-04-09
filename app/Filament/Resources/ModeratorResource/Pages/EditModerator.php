<?php

namespace App\Filament\Resources\ModeratorResource\Pages;

use App\Filament\Resources\ModeratorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModerator extends EditRecord
{
    protected static string $resource = ModeratorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
