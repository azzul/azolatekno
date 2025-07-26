<?php

namespace App\Filament\Resources\GaleriProdukResource\Pages;

use App\Filament\Resources\GaleriProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleriProduks extends ListRecords
{
    protected static string $resource = GaleriProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
