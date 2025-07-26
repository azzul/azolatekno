<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Kategori;
use App\Models\Warna;
use App\Models\EtalaseKategori;
use App\Models\Brand ;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?string $slug = 'produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_kategori')
                    ->label('Kategori')
                    ->options(Kategori::pluck('nama_kategori', 'id_kategori')->toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set) {
                        // Reset id_etalase setiap kali id_kategori berubah
                        $set('id_etalase', null);
                    }),
                Forms\Components\Select::make('kode_warna')
                    ->label('Kode Warna')
                    ->options(
                        Warna::all()->mapWithKeys(function ($warna) {
                            return [$warna->kode_warna => "{$warna->nama_warna} - {$warna->kode_warna}"];
                        })->toArray()
                    )
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $namaWarna = Warna::where('kode_warna', $state)->value('nama_warna');
                        $set('nama_warna', $namaWarna);
                    }),

                Forms\Components\TextInput::make('nama_warna')
                    ->label('Nama Warna')
                    ->required(),
                Forms\Components\TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required()
                    ->reactive() // Memicu pembaruan state
                    ->debounce(1500) // Menambahkan jeda 2 detik
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Update slug_produk setelah jeda
                        $set('slug_produk', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('kode_produk')
                    ->label('Kode Produk')
                    ->default(fn ($get) => str_pad($get('id_kategori'), 2, '0', STR_PAD_LEFT) . str_pad(0, 5, '0', STR_PAD_LEFT)),
                Forms\Components\TextInput::make('slug_produk')
                    ->label('Slug Produk')
                    ->required()// Membuat slug hanya dapat diubah secara otomatis
                    ->default(fn ($get) => Str::slug($get('nama_produk'))),
                Forms\Components\FileUpload::make('image_produk')
                    ->label('Foto Produk')
                    ->disk('custom_product')
                    ->required()
                    ->image()
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, $state): string {
                        // Ambil ekstensi file
                        $extension = $file->getClientOriginalExtension();

                        // Ambil id_kategori dari state
                        $id_kategori = $state['id_kategori'] ?? 'default'; // Gunakan 'default' jika id_kategori tidak ada

                        // Generate timestamp
                        $timestamp = now()->format('YmdHisv');

                        // Return nama file baru
                        return "product-{$id_kategori}{$timestamp}.{$extension}";
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state instanceof \Livewire\TemporaryUploadedFile) {
                            // Simpan nama file baru ke database jika diperlukan
                            $set('image_produk', $state->getClientOriginalName());
                        }
                    }),
                Forms\Components\RichEditor::make('spesifikasi')
                    ->label('Spesifikasi Produk')
                    ->required(),

                Forms\Components\TextInput::make('short_desc_produk')
                    ->label('Deskripsi Singkat')
                    ->required(),

                Forms\Components\Select::make('id_brand')
                    ->label('Brand')
                    ->options(Brand::pluck('brand', 'id_brand')->toArray())
                    ->required(),
               Forms\Components\Select::make('id_etalase')
                    ->label('Etalase')
                    ->options(function (callable $get) {
                        // Ambil id_kategori yang dipilih
                        $idKategori = $get('id_kategori');

                        // Jika id_kategori valid, ambil etalase yang sesuai
                        if ($idKategori) {
                            return EtalaseKategori::where('id_kategori', $idKategori)
                                ->pluck('etalase', 'id_etalase')
                                ->toArray();
                        }

                        // Jika tidak ada kategori yang dipilih, kembalikan array kosong
                        return [];
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Setelah id_etalase dipilih, ambil nama etalase yang sesuai
                        $etalase = EtalaseKategori::where('id_etalase', $state)->value('etalase');

                        // Set nilai etalase ke kolom 'etalase'
                        $set('etalase', $etalase);
                    }),

                Forms\Components\TextInput::make('etalase')
                    ->label('Etalase')
                    ->required(),
                
                Forms\Components\Select::make('is_price')
                    ->label('Tampilkan Harga?')
                    ->options([
                        'Y' => 'Aktif',
                        'N' => 'Tidak',
                    ])
                    ->required(),
                Forms\Components\Select::make('is_available')
                    ->label('Tersedia?')
                    ->options([
                        'Y' => 'Tersedia',
                        'N' => 'Habis',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_produk')->label('Kode Produk'),
                Tables\Columns\TextColumn::make('nama_produk')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('warna.nama_warna')->label('Warna'),
                Tables\Columns\TextColumn::make('etalaseKategori.etalase')->label('Etalase'),
                Tables\Columns\TextColumn::make('is_price')->label('Ada Harga'),
                Tables\Columns\TextColumn::make('is_available')->label('Tersedia'),
                ImageColumn::make('image_produk')
                ->label('Gambar')
                ->getStateUsing(function ($record) {
                    // Menggunakan helper asset() untuk mendapatkan URL gambar
                    return asset('img/product/' . $record->image_produk);
                }),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
