<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Filament\Resources\KategoriResource\RelationManagers;
use App\Models\Kategori;
use App\Models\KategoriTipe;
use App\Models\KategoriUtama;
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

class KategoriResource extends Resource
{

    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-duplicate';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $pluralLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Kategori Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Generate slug ketika nama_kategori diubah
                        // Cek jika state sudah memiliki nilai dan slug belum diisi
                        if (!empty($state)) {
                            $set('slug_kategori', Str::slug($state));
                        }
                    })
                    ->dehydrateStateUsing(function ($state) {
                        // Menggunakan dehydrateState untuk memastikan state tidak hilang saat focus hilang
                        return $state;
                    }),
                
                Forms\Components\FileUpload::make('img_kategori')
                    ->label('Gambar Kategori')
                    ->disk('custom_category')
                    ->required()
                    ->image()
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
                            $set('img_kategori', $state->getClientOriginalName()); // Menyimpan nama file asli jika perlu
                        }
                    }),
               Forms\Components\TextInput::make('slug_kategori')
                    ->label('Slug Kategori') // Menyembunyikan input field
                    ->required()
                    ->maxLength(100),
               Forms\Components\Select::make('kode_ktgtipe')
                    ->label('Kode Kategori')
                    ->options(function () {
                        // Mengambil daftar pilihan dari model KategoriTipe berdasarkan kode_ktgtipe dan tipe_kategori
                        return KategoriTipe::pluck('tipe_kategori', 'kode_ktgtipe')->toArray();
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Mengambil data KategoriTipe berdasarkan kode_ktgtipe yang dipilih
                        $kategoriTipe = KategoriTipe::find($state);

                        if ($kategoriTipe) {
                            // Mengisi id_ktgtipe berdasarkan kode_ktgtipe yang dipilih
                            // Menyimpan tipe kategori
                            $set('tipe_kategori', $kategoriTipe->tipe_kategori);
                        }
                    }),

                Forms\Components\TextInput::make('tipe_kategori')
                    ->label('Tipe Kategori')
                    ->required(),
                Forms\Components\Select::make('id_ukategori')
                    ->label('Kategori Utama')
                    ->relationship('kategoriUtama', 'kategori_utama')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi_kategori')
                    ->label('Deskripsi Kategori')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('is_active')
                    ->label('Status')
                    ->options([
                        'Y' => 'Aktif',
                        'N' => 'Tidak Aktif',
                    ])
                    ->required(),
                Forms\Components\Select::make('no_urut')
                    ->label('Nomor Urut')
                    ->options(
                        collect(range(0, 100))->mapWithKeys(function ($number) {
                            $used = Kategori::where('no_urut', $number)->exists();
                            return [$number => $used ? "$number ✔" : $number];
                        })
                    )
                    ->required(),
                
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_kategori')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nama_kategori')->label('Nama Kategori')->searchable(),
                 ImageColumn::make('img_kategori')
                ->label('Gambar')
                ->getStateUsing(function ($record) {
                    // Menggunakan helper asset() untuk mendapatkan URL gambar
                    return asset('img/category/' . $record->img_kategori);
                }),
                Tables\Columns\TextColumn::make('slug_kategori')->label('Slug')->searchable(),
                Tables\Columns\TextColumn::make('kategoriTipe.tipe_kategori')->label('Tipe Kategori'),
                Tables\Columns\TextColumn::make('kategoriUtama.kategori_utama')->label('Kategori Utama'),
                Tables\Columns\TextColumn::make('is_active')->label('Status'),
                Tables\Columns\TextColumn::make('no_urut')->label('No Urut')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Dibuat')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Tanggal Diperbarui')->sortable(),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }

}
