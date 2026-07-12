<?php

namespace App\Filament\Resources\FormSchemas;

use App\Filament\Resources\FormSchemas\Pages\CreateFormSchema;
use App\Filament\Resources\FormSchemas\Pages\EditFormSchema;
use App\Filament\Resources\FormSchemas\Pages\ListFormSchemas;
use App\Filament\Resources\FormSchemas\Pages\ViewFormSchema;
use App\Filament\Resources\FormSchemas\Schemas\FormSchemaInfolist;
use App\Models\FormSchema;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FormSchemaResource extends Resource
{
    protected static ?string $model = FormSchema::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Form Tracer Study';
    protected static ?string $modelLabel = 'Form Tracer Study';
    protected static ?string $pluralModelLabel = 'Form Tracer Study';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Form')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Form')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: Tracer Study 2025'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->nullable(),

                        Toggle::make('is_active')
                            ->label('Aktifkan Form Ini')
                            ->helperText('Hanya satu form yang bisa aktif. Mengaktifkan form ini akan menonaktifkan form lain.')
                            ->default(false),
                    ]),

                Section::make('Field Dinamis')
                    ->description('Tambahkan field tambahan di luar field bawaan sistem.')
                    ->schema([
                        Repeater::make('fields')
                            ->label('Daftar Field')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('key')
                                        ->label('Key (unik, tanpa spasi)')
                                        ->required()
                                        ->alphaDash()
                                        ->placeholder('contoh: saran_madrasah'),

                                    TextInput::make('label')
                                        ->label('Label (ditampilkan ke alumni)')
                                        ->required()
                                        ->placeholder('contoh: Saran untuk Madrasah'),
                                ]),

                                Grid::make(2)->schema([
                                    Select::make('type')
                                        ->label('Tipe Field')
                                        ->required()
                                        ->options([
                                            'text'     => 'Text (satu baris)',
                                            'textarea' => 'Textarea (paragraf)',
                                            'select'   => 'Dropdown (pilihan)',
                                            'radio'    => 'Radio (pilih satu)',
                                            'checkbox' => 'Checkbox (pilih banyak)',
                                            'date'     => 'Tanggal',
                                            'number'   => 'Angka',
                                        ])
                                        ->live(),

                                    Toggle::make('required')
                                        ->label('Wajib Diisi')
                                        ->default(false),
                                ]),

                                // Options hanya muncul untuk select, radio, checkbox
                                TagsInput::make('options')
                                    ->label('Pilihan (pisahkan dengan Enter)')
                                    ->helperText('Isi pilihan untuk dropdown / radio / checkbox')
                                    ->visible(fn (Get $get) => in_array(
                                        $get('type'), ['select', 'radio', 'checkbox']
                                    ))
                                    ->nullable(),

                                Textarea::make('helper_text')
                                    ->label('Teks Bantuan (opsional)')
                                    ->rows(2)
                                    ->placeholder('Contoh: Isi dengan nama lengkap sesuai ijazah')
                                    ->nullable(),
                            ])
                            ->addActionLabel('Tambah Field')
                            ->collapsible()
                            ->cloneable()
                            ->reorderable()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FormSchemaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Form')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('alumni_responses_count')
                    ->label('Respons Masuk')
                    ->counts('alumniResponses')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('activate')
                    ->label('Aktifkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (FormSchema $record) => ! $record->is_active)
                    ->requiresConfirmation()
                    ->modalHeading('Aktifkan Form Ini?')
                    ->modalDescription('Form lain yang sedang aktif akan dinonaktifkan otomatis.')
                    ->action(function (FormSchema $record) {
                        $record->is_active = true;
                        $record->save();

                        Notification::make()
                            ->title('Form berhasil diaktifkan')
                            ->success()
                            ->send();
                    }),

                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn (FormSchema $record) => $record->alumniResponses()->count() === 0),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormSchemas::route('/'),
            'create' => CreateFormSchema::route('/create'),
            'view' => ViewFormSchema::route('/{record}'),
            'edit' => EditFormSchema::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        // Pastikan key field unik dalam satu form
        $keys = array_column($data['fields'] ?? [], 'key');
        if (count($keys) !== count(array_unique($keys))) {
            Notification::make()
                ->title('Key field harus unik dalam satu form')
                ->danger()
                ->send();

            throw new \Exception('Duplicate field key detected.');
        }

        return $data;
    }
}
