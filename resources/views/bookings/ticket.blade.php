<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Booking - {{ $booking->booking_code }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #4f46e5;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0 0;
        }
        .ticket-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9fafb;
            margin-bottom: 30px;
        }
        .status-badge {
            background-color: #d1fae5;
            color: #065f46;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .grid {
            width: 100%;
            border-collapse: collapse;
        }
        .grid td {
            padding: 10px;
            vertical-align: top;
        }
        .label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: bold;
        }
        .value {
            font-size: 16px;
            color: #111;
            font-weight: bold;
            margin-top: 5px;
        }
        .room-details {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .room-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .room-details th, .room-details td {
            border: 1px solid #eee;
            padding: 12px;
            text-align: left;
        }
        .room-details th {
            background-color: #f3f4f6;
            font-size: 14px;
            color: #374151;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .qr-placeholder {
            width: 120px;
            height: 120px;
            background-color: #fff;
            border: 1px solid #ddd;
            float: right;
            text-align: center;
            line-height: 120px;
            font-size: 10px;
            color: #bbb;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>RoomBooking</h1>
        <p>E-Ticket Reservasi Ruangan Premium</p>
    </div>

    <div class="ticket-box">
        <div class="qr-placeholder">
            [ QR Code Area ]
        </div>
        
        <div class="status-badge">LUNAS</div>
        
        <table class="grid" style="width: 70%;">
            <tr>
                <td>
                    <div class="label">Kode Booking</div>
                    <div class="value" style="color: #4f46e5; font-size: 20px;">{{ $booking->booking_code }}</div>
                </td>
                <td>
                    <div class="label">Nama Pemesan</div>
                    <div class="value">{{ $booking->user->name }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Check-in</div>
                    <div class="value">{{ $booking->check_in_date->format('d M Y') }}</div>
                </td>
                <td>
                    <div class="label">Check-out</div>
                    <div class="value">{{ $booking->check_out_date->format('d M Y') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="room-details">
        <h3>Detail Ruangan & Tagihan</h3>
        <table>
            <thead>
                <tr>
                    <th>Item / Ruangan</th>
                    <th>Peserta</th>
                    <th>Durasi</th>
                    <th style="text-align: right;">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $booking->room->name }}</strong><br>
                        <span style="font-size: 12px; color: #666;">Kap: {{ $booking->room->capacity }} org</span>
                    </td>
                    <td>{{ $booking->guests }} org</td>
                    <td>{{ max(1, $booking->check_in_date->diffInDays($booking->check_out_date)) }} Hari</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        @if($booking->notes)
        <div style="margin-top: 20px; padding: 15px; background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: 5px;">
            <div class="label">Catatan Khusus:</div>
            <div style="font-size: 14px; margin-top: 5px; font-style: italic;">{{ $booking->notes }}</div>
        </div>
        @endif
    </div>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan RoomBooking.</p>
        <p>Harap tunjukkan e-ticket ini kepada resepsionis saat check-in.</p>
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

</body>
</html>
