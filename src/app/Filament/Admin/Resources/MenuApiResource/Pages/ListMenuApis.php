<?php

namespace App\Filament\Admin\Resources\MenuApiResource\Pages;

use App\Filament\Admin\Resources\MenuApiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuApis extends ListRecords
{
    protected static string $resource = MenuApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
