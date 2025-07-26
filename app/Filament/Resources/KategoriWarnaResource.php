<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriWarnaResource\Pages;
use App\Filament\Resources\KategoriWarnaResource\RelationManagers;
use App\Models\KategoriWarna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class KategoriWarnaResource extends Resource
{
    protected static ?string $model = KategoriWarna::class;

    protected static ?string $navigationIcon = 'heroicon-s-paint-brush';
    protected static ?string $navigationGroup = 'Warna';
    protected static ?int $navigationSort = 3;
    public static function getPluralLabel(): string
    {
        return 'Kategori Warna'; // Optional: adjust plural form if necessary
    }
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('kategori_warna')
                    ->label('Kategori Warna')
                    ->required()
                    ->maxLength(30),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id_ktgwarna')->label('ID')->sortable(),
                TextColumn::make('kategori_warna')->label('Kategori Warna')->searchable(),
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
            'index' => Pages\ListKategoriWarnas::route('/'),
            'create' => Pages\CreateKategoriWarna::route('/create'),
            'edit' => Pages\EditKategoriWarna::route('/{record}/edit'),
        ];
    }
}
