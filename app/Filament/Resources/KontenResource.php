<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontenResource\Pages;
use App\Models\Konten;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Filters\Filter;

class KontenResource extends Resource
{
    protected static ?string $model = Konten::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Konten';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nama_konten')
                    ->required()
                    ->label('Nama Konten'),
                TextInput::make('judul')
                    ->required()
                    ->label('Judul'),
                Textarea::make('konten')
                    ->required()
                    ->label('Isi Konten'),
                DateTimePicker::make('created_at')
                    ->label('Dibuat Pada')
                    ->disabled(),
                DateTimePicker::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->disabled(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_konten')->label('Nama Konten')->sortable(),
                TextColumn::make('judul')->label('Judul')->sortable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
                TextColumn::make('updated_at')->label('Diperbarui')->dateTime(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Dibuat Setelah')
                    ->form([
                        DateTimePicker::make('created_at_from')->label('Dari'),
                        DateTimePicker::make('created_at_to')->label('Sampai'),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['created_at_from'], fn ($q) => $q->where('created_at', '>=', $data['created_at_from']))
                        ->when($data['created_at_to'], fn ($q) => $q->where('created_at', '<=', $data['created_at_to']))),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKontens::route('/'),
            'create' => Pages\CreateKonten::route('/create'),
            'edit' => Pages\EditKonten::route('/{record}/edit'),
        ];
    }
}
