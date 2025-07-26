<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HargaResource\Pages;
use App\Models\Harga;
use App\Models\Produk;
use App\Models\VariasiProduk;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class HargaResource extends Resource
{
    protected static ?string $model = Harga::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Harga Produk';
    protected static ?string $slug = 'harga';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('kode_produk')
                    ->label('Produk')
                    ->options(Produk::pluck('nama_produk', 'kode_produk'))
                    ->searchable()
                    ->required(),

                Select::make('kode_variasi')
                    ->label('Variasi')
                    ->options(VariasiProduk::pluck('value', 'kode_variasi'))
                    ->searchable()
                    ->required(),

                TextInput::make('harga_grosir')
                    ->label('Harga Grosir')
                    ->numeric()
                    ->required(),

                TextInput::make('harga_ecer')
                    ->label('Harga Eceran')
                    ->numeric()
                    ->required(),

                TextInput::make('satuan')
                    ->label('Satuan')
                    ->maxLength(20)
                     ->placeholder('Pilih atau masukkan atribut baru')
                        ->datalist([
                            'Pcs',
                            'Pack',
                            'Lusin',
                            'Kodi',
                        ])
                        ->required()
                        ->helperText('Anda bisa memilih dari daftar atau mengetik atribut baru.'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('produk.nama_produk')
                    ->label('Produk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('variasi.value')
                    ->label('Variasi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('harga_grosir')
                    ->label('Harga Grosir')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('harga_ecer')
                    ->label('Harga Eceran')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('satuan')
                    ->label('Satuan')
                    ->sortable(),
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
            'index' => Pages\ListHarga::route('/'),
            'create' => Pages\CreateHarga::route('/create'),
            'edit' => Pages\EditHarga::route('/{record}/edit'),
        ];
    }
}