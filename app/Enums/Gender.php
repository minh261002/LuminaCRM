<?php

namespace App\Enums;

use App\Supports\Enum;

enum Gender: string
{
    use Enum;

    case Male = 'male';

    case Female = 'female';

    case Other = 'other';

    public function badge(): string
    {
        return match ($this) {
            Gender::Male => 'bg-green text-green-fg',
            Gender::Female => 'bg-blue text-blue-fg',
            Gender::Other => 'bg-yellow text-yellow-fg',
        };
    }
}