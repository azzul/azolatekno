<?php

namespace App\Filament\Resources\TipeWarnaResource\Pages;

use App\Filament\Resources\TipeWarnaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipeWarna extends EditRecord
{
    protected static string $resource = TipeWarnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
