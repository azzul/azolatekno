<?php

namespace App\Filament\Resources\KontenKategoriResource\Pages;

use App\Filament\Resources\KontenKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKontenKategoris extends ListRecords
{
    protected static string $resource = KontenKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
