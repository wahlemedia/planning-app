<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\GetValues;

enum ProgramStateEnum: string
{
    use GetValues;


    case DRAFT = 'draft';
    case REVIEWING = 'reviewing';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
