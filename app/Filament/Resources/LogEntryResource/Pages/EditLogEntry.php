<?php

namespace App\Filament\Resources\LogEntryResource\Pages;

use App\Filament\Resources\LogEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogEntry extends EditRecord
{
    protected static string $resource = LogEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
