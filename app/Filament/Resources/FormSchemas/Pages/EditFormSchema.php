<?php

namespace App\Filament\Resources\FormSchemas\Pages;

use App\Filament\Resources\FormSchemas\FormSchemaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFormSchema extends EditRecord
{
    protected static string $resource = FormSchemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getUpdatedNotificationTitle(): string
    {
        return 'form berhasil diupdate';
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
