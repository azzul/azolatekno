<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeWarnaResource\Pages;
use App\Filament\Resources\TipeWarnaResource\RelationManagers;
use App\Models\TipeWarna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class TipeWarnaResource extends Resource
{
    protected static ?string $model = TipeWarna::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';
    protected static ?string $navigationGroup = 'Warna';
    protected static ?int $navigationSort = 4;
    public static function getPluralLabel(): string
    {
        return 'Tipe Warna'; // Optional: adjust plural form if necessary
    }
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('tipe_warna')
                    ->label('Tipe Warna')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id_tipewarna')->label('id_tipewarna')->sortable(),
                TextColumn::make('tipe_warna')->label('Tipe Warna')->searchable(),
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
            'index' => Pages\ListTipeWarnas::route('/'),
            'create' => Pages\CreateTipeWarna::route('/create'),
            'edit' => Pages\EditTipeWarna::route('/{record}/edit'),
        ];
    }
}