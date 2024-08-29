<?php

namespace App\Filament\Resources\ResponseResource\Pages;

use App\Filament\Resources\ResponseResource;
use App\Filament\Widgets\LogViewer;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewResponse extends ViewRecord
{
    protected static string $resource = ResponseResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            LogViewer::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
