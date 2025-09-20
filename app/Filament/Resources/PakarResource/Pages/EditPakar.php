<?php

namespace App\Filament\Resources\PakarResource\Pages;

use App\Filament\Resources\PakarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPakar extends EditRecord
{
    protected static string $resource = PakarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
