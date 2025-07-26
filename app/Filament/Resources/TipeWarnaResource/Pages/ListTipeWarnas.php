<?php

namespace App\Filament\Resources\TipeWarnaResource\Pages;

use App\Filament\Resources\TipeWarnaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipeWarnas extends ListRecords
{
    protected static string $resource = TipeWarnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
