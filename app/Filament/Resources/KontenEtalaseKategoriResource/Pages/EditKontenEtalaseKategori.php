<?php

namespace App\Filament\Resources\KontenEtalaseKategoriResource\Pages;

use App\Filament\Resources\KontenEtalaseKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontenEtalaseKategori extends EditRecord
{
    protected static string $resource = KontenEtalaseKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
