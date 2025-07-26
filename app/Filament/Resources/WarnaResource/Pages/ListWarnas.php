<?php

namespace App\Filament\Resources\WarnaResource\Pages;

use App\Filament\Resources\WarnaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWarnas extends ListRecords
{
    protected static string $resource = WarnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
