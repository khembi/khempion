<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\LogEntry;

class LogEntryChart extends ChartWidget
{
    protected static ?string $heading = 'Log Entry Chart';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $data = Trend::model(LogEntry::class)
        ->between(
            start: now()->subMonths(2)->startOfMonth(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
 
        return [
            'datasets' => [
                [
                    'label' => 'Log Entries',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
