<?php

namespace App\Filament\Admin\Resources\MenuApiResource\Pages;

use App\Filament\Admin\Resources\MenuApiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuApi extends EditRecord
{
    protected static string $resource = MenuApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
