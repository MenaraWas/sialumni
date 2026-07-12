<?php

namespace App\Filament\Resources\FormSchemas\Pages;

use App\Filament\Resources\FormSchemas\FormSchemaResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFormSchemas extends ListRecords
{
    protected static string $resource = FormSchemaResource::class;

    protected function getHeaderActions(): array
    {
        $activeForm = \App\Models\FormSchema::getActive();

        return [

            Action::make('preview')
                ->label('Preview Form')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(route('tracer.form'), shouldOpenInNewTab: true)
                ->visible(fn () => $activeForm !== null),

            CreateAction::make()->label('Buat Form Baru')->icon('heroicon-o-plus'),
        ];
    }
}
