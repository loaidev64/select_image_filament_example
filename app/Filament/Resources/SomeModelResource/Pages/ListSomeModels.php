<?php

namespace App\Filament\Resources\SomeModelResource\Pages;

use App\Filament\Resources\SomeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSomeModels extends ListRecords
{
    protected static string $resource = SomeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
