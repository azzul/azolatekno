<?php

namespace App\Filament\Resources\EtalaseKategoriResource\Pages;

use App\Filament\Resources\EtalaseKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEtalaseKategoris extends ListRecords
{
    protected static string $resource = EtalaseKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
