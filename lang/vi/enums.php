<?php

use App\Enums\ModuleStatus;
use App\Enums\Gender;

return [
    ModuleStatus::class => [
        ModuleStatus::Completed->value => 'Hoàn thành',
        ModuleStatus::InProgress->value => 'Đang tiến hành',
    ],
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ]
];
