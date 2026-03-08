<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends StatsOverviewWidget
{
    public User $record;

    protected int|string|array $columnSpan = 'full';

    protected int|array|null $columns = 4;

    protected function getStats(): array
    {
        return [
            Stat::make('Naložena gradiva', $this->record->uploadCount())
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color('primary'),
            Stat::make('Prenosi', $this->record->downloadCount())
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('info'),
            Stat::make('Shranjena gradiva', $this->record->savedCount())
                ->descriptionIcon('heroicon-m-bookmark')
                ->color('warning'),
            Stat::make('Komentarji', $this->record->commentCount())
                ->descriptionIcon('heroicon-m-chat-bubble-left')
                ->color('success'),
        ];
    }
}
