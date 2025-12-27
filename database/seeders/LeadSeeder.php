<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leads = [
            [
                'name' => 'PT Teknologi Maju Jaya',
                'contact' => '08123456789 (Budi Santoso)',
                'address' => 'Jl. Sudirman No. 45, Jakarta Pusat',
                'requirements' => 'Kebutuhan internet dedicated 100Mbps untuk kantor utama.',
                'status' => 'Baru',
            ],
            [
                'name' => 'Restoran Rasa Nusantara',
                'contact' => '08987654321 (Siti Aminah)',
                'address' => 'Jl. Malioboro No. 12, Yogyakarta',
                'requirements' => 'WiFi untuk pelanggan dan sistem kasir online.',
                'status' => 'Follow Up',
            ],
            [
                'name' => 'Hotel Bintang Lima',
                'contact' => '021-555666 (Pak Handoko)',
                'address' => 'Jl. Thamrin No. 88, Jakarta Pusat',
                'requirements' => 'Upgrade bandwidth ke 500Mbps dan IP Public.',
                'status' => 'Closing',
            ],
            [
                'name' => 'Sekolah Harapan Bangsa',
                'contact' => '08567891234 (Ibu Ratna)',
                'address' => 'Jl. Pendidikan No. 1, Bandung',
                'requirements' => 'Internet stabil untuk lab komputer 50 PC.',
                'status' => 'Baru',
            ],
            [
                'name' => 'Toko Online Sukses',
                'contact' => '0811223344 (Dani)',
                'address' => 'Ruko Grand Galaxy, Bekasi',
                'requirements' => 'Koneksi backup 50Mbps.',
                'status' => 'Follow Up',
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}
