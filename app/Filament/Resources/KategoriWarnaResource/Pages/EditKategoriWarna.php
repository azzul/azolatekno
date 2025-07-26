<?php

namespace App\Filament\Resources\KategoriWarnaResource\Pages;

use App\Filament\Resources\KategoriWarnaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriWarna extends EditRecord
{
    protected static string $resource = KategoriWarnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
