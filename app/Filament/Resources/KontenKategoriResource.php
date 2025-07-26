<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontenKategoriResource\Pages;
use App\Filament\Resources\KontenKategoriResource\RelationManagers;
use App\Models\KontenKategori;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Carbon\Carbon;

class KontenKategoriResource extends Resource
{
    protected static ?string $model = KontenKategori::class;

    protected static ?string $navigationIcon = 'heroicon-s-bars-3-bottom-left';

    protected static ?string $navigationLabel = 'Konten Kategori';

    protected static ?string $pluralModelLabel = 'Konten Kategori';
    protected static ?string $navigationGroup = 'Kategori Produk';

    protected static ?string $slug = 'konten-kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kategori')
                    ->label('Kategori')
                    ->options(Kategori::pluck('nama_kategori', 'id_kategori')->toArray())
                    ->required(),
                Forms\Components\RichEditor::make('long_desc')
                    ->label('Deskripsi Panjang')
                    ->required(),
                Forms\Components\RichEditor::make('penggunaan')
                    ->label('Penggunaan')
                    ->required(),
                Forms\Components\RichEditor::make('perawatan')
                    ->label('Perawatan')
                    ->required(),
                Forms\Components\FileUpload::make('img_konten')
                    ->label('Gambar Konten')
                    ->disk('custom_contentcategory')
                    ->required()
                    ->image()
                    ->acceptedFileTypes(['image/png', 'image/webp', 'image/jpg', 'image/jpeg'])
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        // Ambil ekstensi file
                        $extension = $file->getClientOriginalExtension();
                        
                        // Generate nama file baru dengan timestamp
                        $timestamp = Carbon::now()->format('YmdHisv');
                        
                        // Return nama file baru tanpa folder path, hanya nama file
                        return "content-{$timestamp}.{$extension}";
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state instanceof \Livewire\TemporaryUploadedFile) {
                            // Simpan nama file baru ke database
                            $set('img_konten', $state->getClientOriginalName()); // Menyimpan nama file asli jika perlu
                        }
                    }),
                Forms\Components\FileUpload::make('src_video')
                    ->label('Video (Opsional)')
                    ->disk('custom_video')
                    ->image()
                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mov', 'video/mkv'])
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        // Ambil ekstensi file
                        $extension = $file->getClientOriginalExtension();
                        
                        // Generate nama file baru dengan timestamp
                        $timestamp = Carbon::now()->format('YmdHisv');
                        
                        // Return nama file baru tanpa folder path, hanya nama file
                        return "category-{$timestamp}.{$extension}";
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state instanceof \Livewire\TemporaryUploadedFile) {
                            // Simpan nama file baru ke database
                            $set('src_video', $state->getClientOriginalName()); // Menyimpan nama file asli jika perlu
                        }
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('long_desc')
                    ->label('Deskripsi Panjang')
                    ->limit(50),
                Tables\Columns\TextColumn::make('penggunaan')
                    ->label('Penggunaan')
                    ->limit(50),
                Tables\Columns\TextColumn::make('perawatan')
                    ->label('Perawatan')
                    ->limit(50),
                ImageColumn::make('img_konten')
                ->label('Gambar')
                ->getStateUsing(function ($record) {
                    // Menggunakan helper asset() untuk mendapatkan URL gambar
                    return asset('img/category/content/' . $record->img_konten);
                }),
                Tables\Columns\TextColumn::make('src_video')
                    ->label('Video')
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime(),
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
            'index' => Pages\ListKontenKategoris::route('/'),
            'create' => Pages\CreateKontenKategori::route('/create'),
            'edit' => Pages\EditKontenKategori::route('/{record}/edit'),
        ];
    }
}
