<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontenEtalaseKategoriResource\Pages;
use App\Filament\Resources\KontenEtalaseKategoriResource\RelationManagers;
use App\Models\KontenEtalaseKategori;
use App\Models\EtalaseKategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Carbon\Carbon;

class KontenEtalaseKategoriResource extends Resource
{
    protected static ?string $model = KontenEtalaseKategori::class;

    protected static ?string $navigationIcon = 'heroicon-s-bars-3-bottom-right';

    protected static ?string $navigationLabel = 'Konten Etalase';

    protected static ?string $pluralModelLabel = 'Konten Etalase';
    protected static ?string $navigationGroup = 'Kategori Produk';

    protected static ?string $slug = 'konten-etalase-kategori';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_etalase')
                    ->label('Etalase')
                    ->options(EtalaseKategori::pluck('etalase', 'id_etalase')->toArray())
                    ->required(),
                Forms\Components\Select::make('judul')
                    ->label('Judul')
                    ->options([
                        'Pengertian' => 'Pengertian',
                        'Kelembutan' => 'Kelembutan',
                        'Kenyamanan' => 'Kenyamanan',
                        'Kualitas' => 'Kualitas',
                        'Daya Serap' => 'Daya Serap',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('isi')
                    ->label('Isi')
                    ->required(),
                Forms\Components\TextInput::make('jenis_konten')
                    ->label('Jenis Konten')
                    ->required(),
                Forms\Components\FileUpload::make('img_konten')
                    ->label('Gambar (Opsional)')
                    ->disk('custom_contentetalase')
                    ->required()
                    ->image()
                    ->nullable()
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('etalaseKategori.etalase')
                    ->label('Etalase'),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul'),
                Tables\Columns\TextColumn::make('isi')
                    ->label('Isi')
                    ->limit(50),
                Tables\Columns\TextColumn::make('jenis_konten')
                    ->label('Jenis Konten'),
                ImageColumn::make('img_konten')
                ->label('Gambar')
                ->getStateUsing(function ($record) {
                    // Menggunakan helper asset() untuk mendapatkan URL gambar
                    return asset('img/etalase/content/' . $record->img_konten);
                }),
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
            'index' => Pages\ListKontenEtalaseKategoris::route('/'),
            'create' => Pages\CreateKontenEtalaseKategori::route('/create'),
            'edit' => Pages\EditKontenEtalaseKategori::route('/{record}/edit'),
        ];
    }
}
