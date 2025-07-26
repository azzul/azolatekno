<?php

namespace App\Filament\Resources\VariasiProdukResource\Pages;

use App\Filament\Resources\VariasiProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVariasiProduks extends ListRecords
{
    protected static string $resource = VariasiProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
