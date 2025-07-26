<?php

namespace App\Filament\Resources\GaleriProdukResource\Pages;

use App\Filament\Resources\GaleriProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleriProduk extends EditRecord
{
    protected static string $resource = GaleriProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
