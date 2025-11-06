<?php

namespace App\Enums;

use App\Supports\Enum;

enum IdentityType: string
{
    use Enum;

    case CCCD = 'cccd';

    case CMND = 'cmnd';

    case Passport = 'passport';

    public function badge(): string
    {
        return match ($this) {
            IdentityType::CCCD => 'bg-green text-green-fg',
            IdentityType::CMND => 'bg-blue text-blue-fg',
            IdentityType::Passport => 'bg-yellow text-yellow-fg',
        };
    }
}
