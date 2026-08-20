<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomContentResource\Pages;
use App\Models\CustomContent;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

class CustomContentResource extends Resource
{
    protected static ?string $model = CustomContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Halaman Kota / Custom';
    protected static ?string $modelLabel = 'Halaman Kota / Custom';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(230)
                    ->label('Judul (Meta Title)')
                    ->columnSpanFull(),

                TextInput::make('slug_content')
                    ->required()
                    ->maxLength(210)
                    ->label('Slug URL')
                    ->helperText('URL ini sudah terindeks Google. Jangan diubah setelah halaman live — kalau memang harus, pasang 301 redirect dari slug lama.')
                    ->disabled(fn (string $context) => $context === 'edit')
                    ->dehydrated()
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),

                Textarea::make('short_desc')
                    ->required()
                    ->maxLength(500)
                    ->label('Meta Description / Ringkasan')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('keyword')
                    ->label('Keyword (meta keywords)')
                    ->columnSpanFull(),

                TextInput::make('kategori_konten')
                    ->label('Kategori Konten')
                    ->helperText('Isi "promo" akan otomatis dirender pakai template promo.'),

                TextInput::make('page_name')
                    ->label('Nama Halaman (internal)'),

                TextInput::make('img_content')
                    ->label('Gambar Utama (nama file di img/content/)'),
                TextInput::make('img_medium')
                    ->label('Gambar Medium (nama file)'),
                TextInput::make('img_small')
                    ->label('Gambar Kecil (nama file)'),

                RichEditor::make('isi')
                    ->required()
                    ->label('Isi Konten (HTML)')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Judul')->searchable()->sortable(),
                TextColumn::make('slug_content')->label('Slug')->searchable(),
                TextColumn::make('kategori_konten')->label('Kategori')->sortable(),
                TextColumn::make('updated_at')->label('Diperbarui')->dateTime()->sortable(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomContents::route('/'),
            'create' => Pages\CreateCustomContent::route('/create'),
            'edit' => Pages\EditCustomContent::route('/{record}/edit'),
        ];
    }
}
