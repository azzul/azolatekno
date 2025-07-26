<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriUtamaResource\Pages;
use App\Filament\Resources\KategoriUtamaResource\RelationManagers;
use App\Models\KategoriUtama;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriUtamaResource extends Resource
{
    protected static ?string $model = KategoriUtama::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';
    protected static ?string $navigationLabel = 'Kategori Utama';
    protected static ?string $pluralLabel = 'Kategori Utama';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kategori_utama')
                    ->label('Kategori Utama')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('no_urut')
                    ->label('No Urut')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('is_active')
                    ->label('Aktif')
                    ->required()
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ]),
                Forms\Components\DateTimePicker::make('datetime')
                    ->label('Waktu Dibuat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_ukategori')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('kategori_utama')->label('Kategori Utama')->searchable(),
                Tables\Columns\TextColumn::make('no_urut')->label('No Urut')->sortable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Aktif')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
                Tables\Columns\TextColumn::make('datetime')->label('Waktu Dibuat')->sortable(),
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
            'index' => Pages\ListKategoriUtamas::route('/'),
            'create' => Pages\CreateKategoriUtama::route('/create'),
            'edit' => Pages\EditKategoriUtama::route('/{record}/edit'),
        ];
    }
}
