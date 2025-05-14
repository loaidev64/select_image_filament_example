<?php

namespace App\Filament\Resources\SomeModelResource\Pages;

use App\Filament\Resources\SomeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSomeModel extends EditRecord
{
    protected static string $resource = SomeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
