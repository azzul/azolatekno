<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParameterVariasiResource\Pages;
use App\Models\ParameterVariasi;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ParameterVariasiResource extends Resource
{
    protected static ?string $model = ParameterVariasi::class;
    protected static ?string $navigationIcon = 'heroicon-s-archive-box';
    protected static ?string $navigationGroup = 'Manajemen Produk';
    protected static ?string $slug = 'parameter-variasi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('parameter')
                    ->label('Nama Parameter')
                    ->required(),
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->searchable()
                    ->preload()
                    ->required(),
                Toggle::make('is_required')
                    ->label('Wajib?')
                    ->default(false),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('parameter')->label('Nama Parameter')->sortable()->searchable(),
                TextColumn::make('kategori.nama_kategori')->label('Kategori')->sortable(),
                TextColumn::make('is_required')->label('Wajib')->sortable()->boolean(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParameterVariasis::route('/'),
            'create' => Pages\CreateParameterVariasi::route('/create'),
            'edit' => Pages\EditParameterVariasi::route('/{record}/edit'),
        ];
    }
}