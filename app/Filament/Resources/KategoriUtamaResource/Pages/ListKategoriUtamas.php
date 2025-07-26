<?php

namespace App\Filament\Resources\KategoriUtamaResource\Pages;

use App\Filament\Resources\KategoriUtamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriUtamas extends ListRecords
{
    protected static string $resource = KategoriUtamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
