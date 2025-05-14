<?php

namespace App\Filament\Resources\SomeModelResource\Pages;

use App\Filament\Resources\SomeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSomeModel extends CreateRecord
{
    protected static string $resource = SomeModelResource::class;
}
