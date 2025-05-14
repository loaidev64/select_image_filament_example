<?php

namespace App\Helpers\Filament;

use Filament\Forms;
use Illuminate\Support\Facades\Storage;

class SelectImageHelper
{
    public static function component(): Forms\Components\Select
    {
        return Forms\Components\Select::make('image')
            ->options(static::getImages())
            ->allowHtml()
            ->searchable()
            ->required();
    }

    private static function getImages(): array
    {
        $files = Storage::disk('images')->allFiles();
        $images = [];
        foreach ($files as $file) {
            if (static::isPng($file)) {
                $images[$file] = '<img src="' . asset('storage/images/' . $file) . '" class="h-10 w-10" />';
            } else {
                $images[$file] = \Blade::render("@svg('" . storage_path('app/public/images/' . $file) . "', 'w-10 h-10')");
            }
        }
        return $images;
    }

    private static function isPng(string $image): bool
    {
        return str($image)->endsWith('.png');
    }
}
