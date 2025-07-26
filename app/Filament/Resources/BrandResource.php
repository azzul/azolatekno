<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static ?string $navigationIcon = 'heroicon-s-archive-box';
    protected static ?string $navigationLabel = 'Brands';
    protected static ?string $slug = 'brands';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('brand')
                    ->label('Brand Name')
                    ->required()
                    ->maxLength(40),
                FileUpload::make('img_brand')
                    ->label('Brand Image')
                    ->image()
                    ->directory('brands')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('brand')
                    ->label('Brand Name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('img_brand')
                    ->label('Brand Image'),
                TextColumn::make('created_at')
                    ->label('Created At')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}