<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $pluralLabel = 'Settings';

    public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('setting_name')
                        ->label('Setting Name')
                        ->required()
                        ->maxLength(20),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'Y' => 'Ya',
                            'N' => 'Tidak',
                        ])
                        ->required(),
                ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_setting')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('setting_name')->label('Setting Name')->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
