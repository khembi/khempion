<?php

namespace App\Filament\Resources\LogEntryResource\Pages;

use App\Filament\Resources\LogEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLogEntry extends CreateRecord
{
    protected static string $resource = LogEntryResource::class;
}
