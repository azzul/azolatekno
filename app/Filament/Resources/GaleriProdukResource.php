<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriProdukResource\Pages;
use App\Filament\Resources\GaleriProdukResource\RelationManagers;
use App\Models\GaleriProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriProdukResource extends Resource
{
    protected static ?string $model = GaleriProduk::class;

    protected static ?string $navigationIcon = 'heroicon-s-photo';

    protected static ?string $label = 'Galeri Produk';

    protected static ?string $pluralLabel = 'Galeri Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kode_produk')
                    ->label('Kode Produk')
                    ->options(\App\Models\Produk::pluck('nama_produk', 'kode_produk'))
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('src_image')
                    ->label('Gambar')
                    ->image()
                    ->required(),
                Forms\Components\Select::make('is_utama')
                    ->label('Gambar Utama')
                    ->options([
                        'Y' => 'Ya',
                        'N' => 'Tidak',
                    ])
                    ->default('N')
                    ->required(),
                Forms\Components\TextInput::make('desc_image')
                    ->label('Deskripsi Gambar')
                    ->maxLength(30)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('kode_produk')
                ->label('Kode Produk')
                ->searchable(),
            Tables\Columns\ImageColumn::make('src_image')
                ->label('Gambar'),
            Tables\Columns\TextColumn::make('is_utama')
                ->label('Gambar Utama')
                ->formatStateUsing(fn ($state) => $state === 'Y' ? 'Ya' : 'Tidak'),
            Tables\Columns\TextColumn::make('desc_image')
                ->label('Deskripsi'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui Pada')
                ->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleriProduks::route('/'),
            'create' => Pages\CreateGaleriProduk::route('/create'),
            'edit' => Pages\EditGaleriProduk::route('/{record}/edit'),
        ];
    }
}