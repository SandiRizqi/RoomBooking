<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@roombooking.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Create Facilities
        $facilities = [
            ['name' => 'WiFi', 'icon' => '📶'],
            ['name' => 'AC', 'icon' => '❄️'],
            ['name' => 'TV', 'icon' => '📺'],
            ['name' => 'Projector', 'icon' => '📽️'],
            ['name' => 'Whiteboard', 'icon' => '📋'],
            ['name' => 'Sound System', 'icon' => '🔊'],
            ['name' => 'Coffee & Tea', 'icon' => '☕'],
            ['name' => 'Parking', 'icon' => '🅿️'],
        ];

        foreach ($facilities as $facility) {
            \App\Models\Facility::create($facility);
        }

        // Create Rooms
        $rooms = [
            [
                'name' => 'Ruang Rapat Eksekutif',
                'slug' => 'ruang-rapat-eksekutif',
                'description' => '<p>Ruang rapat eksekutif premium dengan fasilitas lengkap, cocok untuk meeting penting dan presentasi besar. Dilengkapi interior modern dan pencahayaan optimal.</p>',
                'capacity' => 20,
                'price_per_day' => 1500000,
                'is_active' => true,
            ],
            [
                'name' => 'Ruang Workshop',
                'slug' => 'ruang-workshop',
                'description' => '<p>Ruang workshop spacious yang ideal untuk pelatihan, seminar, dan kegiatan team building. Layout fleksibel untuk berbagai konfigurasi.</p>',
                'capacity' => 50,
                'price_per_day' => 2500000,
                'is_active' => true,
            ],
            [
                'name' => 'Ruang Meeting Kecil',
                'slug' => 'ruang-meeting-kecil',
                'description' => '<p>Ruang meeting intimate yang nyaman untuk diskusi tim kecil atau interview. Suasana tenang dan privat.</p>',
                'capacity' => 8,
                'price_per_day' => 500000,
                'is_active' => true,
            ],
            [
                'name' => 'Auditorium',
                'slug' => 'auditorium',
                'description' => '<p>Auditorium besar dengan panggung dan sound system profesional. Ideal untuk konferensi, seminar besar, dan acara perusahaan.</p>',
                'capacity' => 200,
                'price_per_day' => 5000000,
                'is_active' => true,
            ],
            [
                'name' => 'Co-Working Space',
                'slug' => 'co-working-space',
                'description' => '<p>Area co-working modern dengan suasana kreatif dan kolaboratif. Dilengkapi dengan meja individu dan area lounge.</p>',
                'capacity' => 30,
                'price_per_day' => 750000,
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $roomData) {
            $room = \App\Models\Room::create($roomData);
            // Attach random facilities
            $facilityIds = \App\Models\Facility::inRandomOrder()->take(rand(3, 6))->pluck('id');
            $room->facilities()->attach($facilityIds);
        }

        // Create News
        $newsArticles = [
            [
                'title' => 'Grand Opening: Fasilitas Baru Tersedia!',
                'slug' => 'grand-opening-fasilitas-baru',
                'content' => '<p>Kami dengan bangga mengumumkan pembukaan fasilitas baru yang telah direnovasi. Nikmati ruangan yang lebih luas, modern, dan nyaman untuk kebutuhan meeting dan acara Anda.</p><p>Dapatkan diskon 20% untuk pemesanan pertama di ruangan baru kami!</p>',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Tips Memilih Ruang Meeting yang Tepat',
                'slug' => 'tips-memilih-ruang-meeting',
                'content' => '<p>Memilih ruang meeting yang tepat adalah kunci suksesnya acara Anda. Berikut beberapa tips yang perlu diperhatikan:</p><ul><li>Sesuaikan kapasitas dengan jumlah peserta</li><li>Periksa ketersediaan fasilitas yang dibutuhkan</li><li>Pertimbangkan lokasi dan aksesibilitas</li><li>Cek review dari pengguna sebelumnya</li></ul>',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Promo Akhir Tahun: Diskon Hingga 30%',
                'slug' => 'promo-akhir-tahun',
                'content' => '<p>Dalam rangka menyambut akhir tahun, kami menghadirkan promo spesial! Dapatkan diskon hingga 30% untuk pemesanan ruangan selama bulan Desember.</p><p>Syarat dan ketentuan berlaku. Hubungi kami untuk informasi lebih lanjut.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
        ];

        foreach ($newsArticles as $newsData) {
            \App\Models\News::create($newsData);
        }

        // Create Gallery
        $galleries = [
            ['title' => 'Lobby Utama', 'description' => 'Area lobby modern dengan desain elegan', 'sort_order' => 1],
            ['title' => 'Ruang Meeting Premium', 'description' => 'Interior ruang meeting eksekutif', 'sort_order' => 2],
            ['title' => 'Area Lounge', 'description' => 'Tempat bersantai yang nyaman', 'sort_order' => 3],
            ['title' => 'Fasilitas Pendukung', 'description' => 'Berbagai fasilitas modern tersedia', 'sort_order' => 4],
        ];

        foreach ($galleries as $galleryData) {
            \App\Models\Gallery::create(array_merge($galleryData, [
                'image_path' => 'galleries/placeholder.jpg',
            ]));
        }
    }
}
