<?php

namespace App\Filament\Resources\KategoriTipeResource\Pages;

use App\Filament\Resources\KategoriTipeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriTipe extends EditRecord
{
    protected static string $resource = KategoriTipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
