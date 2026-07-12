<?php

namespace App\Filament\Resources\FormSchemas\Pages;

use App\Filament\Resources\FormSchemas\FormSchemaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFormSchema extends CreateRecord
{
    protected static string $resource = FormSchemaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): string
    {
        return 'form berhasil dibuat';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $keys = array_column($data['fields'] ?? [], 'key');
        if (count($keys) !== count(array_unique($keys))) {
            
            \Filament\Notifications\Notification::make()
                ->title('Key field tidak boleh duplikat dalam satu form!')
                ->danger()
                ->send();

            $this->halt();
        }

        return $data;
    }
}
