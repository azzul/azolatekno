<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WarnaResource\Pages;
use App\Filament\Resources\WarnaResource\RelationManagers;
use App\Models\Warna;
use App\Models\TipeWarna;
use App\Models\KategoriWarna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;

class WarnaResource extends Resource
{
    protected static ?string $model = Warna::class;

    protected static ?string $navigationIcon = 'heroicon-s-swatch';
    protected static ?string $navigationGroup = 'Warna';
    protected static ?int $navigationSort = 5;
    public static function getPluralLabel(): string
    {
        return 'Warna'; // Optional: adjust plural form if necessary
    }
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('kode_warna')
                    ->label('Kode Warna')
                    ->required()
                    ->maxLength(20),
                TextInput::make('nama_warna')
                    ->label('Nama Warna')
                    ->required()
                    ->maxLength(120),
                TextInput::make('color_name')
                    ->label('Nama Warna (Inggris)')
                    ->required()
                    ->maxLength(120),
                ColorPicker::make('hex_color')
                    ->label('Hex Warna')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id_warna')->label('ID')->sortable(),
                TextColumn::make('kode_warna')->label('Kode Warna')->searchable(),
                TextColumn::make('nama_warna')->label('Nama Warna')->searchable(),
                TextColumn::make('color_name')->label('Nama Warna (Pantone)'),
                TextColumn::make('hex_color')->label('Hex Warna'),
                TextColumn::make('created_at')->label('Tanggal Dibuat')->sortable(),
                TextColumn::make('updated_at')->label('Tanggal Diperbarui')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarnas::route('/'),
            'create' => Pages\CreateWarna::route('/create'),
            'edit' => Pages\EditWarna::route('/{record}/edit'),
        ];
    }
}
