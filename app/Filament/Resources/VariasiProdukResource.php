<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VariasiProdukResource\Pages;
use App\Filament\Resources\VariasiProdukResource\RelationManagers;
use App\Models\VariasiProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class VariasiProdukResource extends Resource
{
    protected static ?string $model = VariasiProduk::class;

    protected static ?string $navigationIcon = 'heroicon-s-archive-box';
    protected static ?string $navigationGroup = 'Produk Management';
    protected static ?string $navigationLabel = 'Variasi Produk';
    protected static ?string $pluralModelLabel = 'Variasi Produk';

   public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('kode_produk')
                ->label('Kode Produk')
                ->relationship(
                    'produk',
                    'nama_produk',
                    fn ($query) => $query->select('id_produk', 'nama_produk', 'kode_produk')
                )
                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nama_produk} ({$record->kode_produk})")
                ->searchable()
                ->preload()
                ->required(),


           Forms\Components\TextInput::make('kode_variasi')
                ->label('Kode Variasi')
                ->required()
                ->unique(ignoreRecord: true), // Agar tidak konflik dengan data lama

            Forms\Components\Radio::make('is_variasi_utama')
                ->label('Variasi Utama')
                ->options([
                    'Y' => 'Ya',
                    'N' => 'Tidak',
                ])
                ->default('N')
                ->required(),
                    Forms\Components\TextInput::make('atribut')
                        ->label('Atribut')
                        ->placeholder('Pilih atau masukkan atribut baru')
                        ->datalist([
                            'Ukuran',
                            'Lengan',
                            'Bahan',
                            'Corak',
                        ])
                        ->required()
                        ->helperText('Anda bisa memilih dari daftar atau mengetik atribut baru.'),

                    Forms\Components\TextInput::make('value')
                        ->label('Nilai Atribut')
                        ->required(),

        ]);
}

   protected static function beforeCreate(array $data): void
        {
            // Debug data sebelum melakukan proses lebih lanjut
              Log::debug('Data sebelum penyimpanan:', $data);
            dd($data);

            // Pastikan setiap variasi memiliki atribut
            foreach ($data['variasi'] as $variasi) {
                if (empty($variasi['atribut'])) {
                    // Berikan nilai default jika atribut kosong
                    $variasi['atribut'] = 'default_value';  // Gantilah dengan nilai yang sesuai
                }
            }

            // Validasi data
            $produk = Produk::findOrFail($data['kode_produk']);

            // Tambahkan variasi dengan detail
            $produk->addVariasiWithDetails($data);

            // Hindari penyimpanan otomatis oleh Filament
            throw new \Exception('Variasi telah ditambahkan secara manual.');
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_variasi')->label('Kode Variasi'),
                Tables\Columns\TextColumn::make('produk.nama_produk')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('atribut')->label('Atribut'),
                Tables\Columns\TextColumn::make('value')->label('Nilai'),
                Tables\Columns\BooleanColumn::make('is_variasi_utama')->label('Variasi Utama'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui Pada')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVariasiProduks::route('/'),
            'create' => Pages\CreateVariasiProduk::route('/create'),
            'edit' => Pages\EditVariasiProduk::route('/{record}/edit'),
        ];
    }
}
