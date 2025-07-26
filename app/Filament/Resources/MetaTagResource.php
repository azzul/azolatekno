<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetaTagResource\Pages;
use App\Filament\Resources\MetaTagResource\RelationManagers;
use App\Models\MetaTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetaTagResource extends Resource
{
    protected static ?string $model = MetaTag::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';
    protected static ?string $navigationLabel = 'Meta Tags';
    protected static ?string $pluralLabel = 'Meta Tags';
    protected static ?string $navigationGroup = 'SEO Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page')
                    ->label('Page')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description'),
                Forms\Components\TextInput::make('keywords')
                    ->label('Keywords')
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_title')
                    ->label('OG Title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_description')
                    ->label('OG Description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('og_image')
                    ->label('OG Image')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('updated_at')
                    ->label('Updated At')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('page')->label('Page')->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(50),
                Tables\Columns\TextColumn::make('og_image')->label('OG Image')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->sortable(),
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
            'index' => Pages\ListMetaTags::route('/'),
            'create' => Pages\CreateMetaTag::route('/create'),
            'edit' => Pages\EditMetaTag::route('/{record}/edit'),
        ];
    }
}
