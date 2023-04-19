<?php

declare(strict_types=1);

namespace App\Filament\Resources\ModeratorResource\Pages;

use App\Filament\Resources\ModeratorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateModerator extends CreateRecord
{
    protected static string $resource = ModeratorResource::class;
}
