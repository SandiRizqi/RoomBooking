<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Data Pemesanan';

    protected static ?string $modelLabel = 'Pemesanan';

    protected static ?string $pluralModelLabel = 'Semua Pemesanan';

    protected static ?string $navigationGroup = 'Manajemen Pemesanan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Pemesanan')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Nama Tamu')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('room_id')
                            ->label('Unit Glamping')
                            ->relationship('room', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('booking_code')
                            ->label('Kode Booking')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Dibuat otomatis'),
                        Forms\Components\TextInput::make('guests')
                            ->label('Jumlah Tamu')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1),
                    ])->columns(2),

                Forms\Components\Section::make('Tanggal & Harga')
                    ->schema([
                        Forms\Components\DatePicker::make('check_in_date')
                            ->label('Tanggal Check-in')
                            ->required()
                            ->native(false),
                        Forms\Components\DatePicker::make('check_out_date')
                            ->label('Tanggal Check-out')
                            ->required()
                            ->native(false)
                            ->after('check_in_date'),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Status & Catatan')
                    ->schema([
                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'unpaid'    => 'Belum Bayar',
                                'paid'      => 'Lunas',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->required()
                            ->default('unpaid'),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_code')
                    ->label('Kode Booking')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Tamu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room.name')
                    ->label('Unit')
                    ->searchable()
                    ->sortable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('check_in_date')
                    ->label('Check-in')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out_date')
                    ->label('Check-out')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'unpaid'    => 'Belum Bayar',
                        'paid'      => 'Lunas',
                        'cancelled' => 'Dibatalkan',
                        default     => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'unpaid'    => 'warning',
                        'paid'      => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tgl. Pesanan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid'    => 'Belum Bayar',
                        'paid'      => 'Lunas',
                        'cancelled' => 'Dibatalkan',
                    ]),
                Tables\Filters\SelectFilter::make('room')
                    ->label('Unit')
                    ->relationship('room', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Pemesanan')
            ->emptyStateDescription('Pemesanan dari tamu akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-calendar-days');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit'   => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
