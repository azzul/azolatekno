<?php

namespace App\Filament\Resources\EtalaseKategoriResource\Pages;

use App\Filament\Resources\EtalaseKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEtalaseKategori extends EditRecord
{
    protected static string $resource = EtalaseKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
