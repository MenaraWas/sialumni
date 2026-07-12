<?php

namespace App\Filament\Resources\FormSchemas\Pages;

use App\Filament\Resources\FormSchemas\FormSchemaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFormSchema extends ViewRecord
{
    protected static string $resource = FormSchemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
