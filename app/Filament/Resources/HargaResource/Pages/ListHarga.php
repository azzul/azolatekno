<?php

namespace App\Filament\Resources\HargaResource\Pages;

use App\Filament\Resources\HargaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHarga extends ListRecords
{
    protected static string $resource = HargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
