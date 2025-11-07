<span @class(['badge', App\Enums\ModuleStatus::from($status)->badge()])>{{ \App\Enums\ModuleStatus::getDescription($status) }}</span>
