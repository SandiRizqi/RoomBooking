<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationLabel = 'Unit Glamping';

    protected static ?string $modelLabel = 'Unit';

    protected static ?string $pluralModelLabel = 'Unit Glamping';

    protected static ?string $navigationGroup = 'Konten Resort';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Unit')
                    ->description('Detail utama unit glamping yang akan ditampilkan ke tamu.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Unit')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Tenda Premium'  => 'Tenda Premium',
                                'Boutique Cabin' => 'Boutique Cabin',
                                'Unit Keluarga'  => 'Unit Keluarga',
                                'Treehouse'      => 'Treehouse',
                                'Lainnya'        => 'Lainnya',
                            ])
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('capacity')
                            ->label('Kapasitas')
                            ->required()
                            ->numeric()
                            ->default(2)
                            ->minValue(1)
                            ->suffix('tamu'),
                        Forms\Components\TextInput::make('price_per_day')
                            ->label('Harga per Malam')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp')
                            ->suffix('/ malam'),
                    ])->columns(2),

                Forms\Components\Section::make('Media & Foto')
                    ->description('Upload foto utama dan galeri tambahan unit.')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->label('Foto Utama (Cover)')
                            ->image()
                            ->directory('rooms/covers')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675'),
                        Forms\Components\FileUpload::make('images')
                            ->label('Galeri Foto Tambahan')
                            ->multiple()
                            ->image()
                            ->directory('rooms/gallery')
                            ->reorderable()
                            ->maxFiles(10),
                        Forms\Components\ColorPicker::make('color')
                            ->label('Warna Penanda Kalender')
                            ->default('#2d4a22'),
                    ]),

                Forms\Components\Section::make('Fasilitas')
                    ->description('Fasilitas yang tersedia di unit ini.')
                    ->schema([
                        Forms\Components\Select::make('facilities')
                            ->label('Pilih Fasilitas')
                            ->relationship('facilities', 'name')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->label('Nama Fasilitas')->required(),
                                Forms\Components\TextInput::make('icon')->label('Emoji / Icon'),
                            ]),
                    ]),

                Forms\Components\Section::make('Status Publikasi')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif & Bisa Dipesan')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn () => null),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Unit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas')
                    ->numeric()
                    ->sortable()
                    ->suffix(' tamu'),
                Tables\Columns\TextColumn::make('price_per_day')
                    ->label('Harga/Malam')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('facilities.name')
                    ->badge()
                    ->label('Fasilitas')
                    ->color('gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Unit')
            ->emptyStateDescription('Tambahkan unit glamping pertama Anda.')
            ->emptyStateIcon('heroicon-o-home-modern');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit'   => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
