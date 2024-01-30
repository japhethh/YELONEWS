<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users',User::count()),
            Stat::make('Active Admins',User::where('role',User::ROLE_ADMIN)->count()),
            Stat::make('Active Editors',User::where('role',User::ROLE_EDITOR)->count()),
        ];
    }
}
