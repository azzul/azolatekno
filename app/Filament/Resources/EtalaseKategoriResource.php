<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EtalaseKategoriResource\Pages;
use App\Filament\Resources\EtalaseKategoriResource\RelationManagers;
use App\Models\Kategori;
use App\Models\EtalaseKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Carbon\Carbon;

class EtalaseKategoriResource extends Resource
{
    protected static ?string $model = EtalaseKategori::class;

    protected static ?string $navigationIcon = 'heroicon-s-archive-box';

    protected static ?string $navigationGroup = 'Kategori Produk';
    protected static ?string $navigationLabel = 'Etalase (Sub-Kategori)';
    protected static ?string $pluralLabel = 'Etalase (Sub-Kategori)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori') // Relasi ke model Kategori
                    ->required(),

                Forms\Components\TextInput::make('etalase')
                    ->label('Nama Etalase')
                    ->required(),

                Forms\Components\FileUpload::make('img_etalase')
                    ->label('Gambar Etalase')
                    ->disk('custom_etalase')
                    ->required()
                    ->image()
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        // Ambil ekstensi file
                        $extension = $file->getClientOriginalExtension();
                        
                        // Generate nama file baru dengan timestamp
                        $timestamp = Carbon::now()->format('YmdHisv');
                        
                        // Return nama file baru tanpa folder path, hanya nama file
                        return "etalase-{$timestamp}.{$extension}";
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state instanceof \Livewire\TemporaryUploadedFile) {
                            // Simpan nama file baru ke database
                            $set('img_etalase', $state->getClientOriginalName()); // Menyimpan nama file asli jika perlu
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('etalase')
                    ->label('Etalase')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('img_etalase')
                ->label('Gambar')
                ->getStateUsing(function ($record) {
                    // Menggunakan helper asset() untuk mendapatkan URL gambar
                    return asset('img/etalase/' . $record->img_etalase);
                }),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEtalaseKategoris::route('/'),
            'create' => Pages\CreateEtalaseKategori::route('/create'),
            'edit' => Pages\EditEtalaseKategori::route('/{record}/edit'),
        ];
    }
}