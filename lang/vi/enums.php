<?php

use App\Enums\Gender;
use App\Enums\IdentityType;
use App\Enums\ModuleStatus;

return [
    ModuleStatus::class => [
        ModuleStatus::Completed->value => 'Hoàn thành',
        ModuleStatus::InProgress->value => 'Đang tiến hành',
    ],
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ],
    IdentityType::class => [
        IdentityType::CCCD->value => 'Căn cước công dân',
        IdentityType::CMND->value => 'Chứng minh nhân dân',
        IdentityType::Passport->value => 'Hộ chiếu',
    ],
];
