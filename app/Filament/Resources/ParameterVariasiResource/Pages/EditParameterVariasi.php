<?php

namespace App\Filament\Resources\ParameterVariasiResource\Pages;

use App\Filament\Resources\ParameterVariasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParameterVariasi extends EditRecord
{
    protected static string $resource = ParameterVariasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
