<?php

namespace App\Filament\Resources\KategoriUtamaResource\Pages;

use App\Filament\Resources\KategoriUtamaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriUtama extends EditRecord
{
    protected static string $resource = KategoriUtamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
