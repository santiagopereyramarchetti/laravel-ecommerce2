<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Unique views', '192.1k')
                ->description('32k icrease')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
            Card::make('Bounce rate', '21%')
                ->description('7% icrease')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('Avergae time on page', '3:12')
                ->description('7% icrease')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success')
        ];
    }
}
