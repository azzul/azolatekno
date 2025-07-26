<?php

namespace App\Filament\Resources\KontenKategoriResource\Pages;

use App\Filament\Resources\KontenKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontenKategori extends EditRecord
{
    protected static string $resource = KontenKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
