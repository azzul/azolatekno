<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriTipeResource\Pages;
use App\Filament\Resources\KategoriTipeResource\RelationManagers;
use App\Models\KategoriTipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriTipeResource extends Resource
{
    protected static ?string $model = KategoriTipe::class;

    protected static ?string $navigationIcon = 'heroicon-s-queue-list';
    protected static ?string $navigationLabel = 'Kategori Tipe';
    protected static ?string $pluralLabel = 'Kategori Tipe';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_ktgtipe')
                    ->label('Kode Kategori Tipe')
                    ->required()
                    ->maxLength(6),
                Forms\Components\TextInput::make('tipe_kategori')
                    ->label('Tipe Kategori')
                    ->required()
                    ->maxLength(30),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_ktgtipe')->label('ID Kategori Tipe')->sortable(),
                Tables\Columns\TextColumn::make('kode_ktgtipe')->label('Kode Kategori Tipe')->searchable(),
                Tables\Columns\TextColumn::make('tipe_kategori')->label('Tipe Kategori')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Dibuat')->sortable(),
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
            'index' => Pages\ListKategoriTipes::route('/'),
            'create' => Pages\CreateKategoriTipe::route('/create'),
            'edit' => Pages\EditKategoriTipe::route('/{record}/edit'),
        ];
    }
}