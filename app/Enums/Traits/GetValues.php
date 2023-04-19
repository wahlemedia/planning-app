<?php

declare(strict_types=1);

namespace App\Enums\Traits;

trait GetValues
{
    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    /**
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        return array_column(static::cases(), 'name', 'value');
    }
}
