<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Owner;
use App\Models\Treatment;
use App\Models\Pet;
use App\Models\Checkup;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Treatments
        $treatments = [
            ['nama' => 'Vaksin Rabies',       'tipe' => 'vaksin',       'deskripsi' => 'Vaksinasi rabies tahunan',          'harga' => 150000],
            ['nama' => 'Vaksin Distemper',     'tipe' => 'vaksin',       'deskripsi' => 'Vaksinasi distemper untuk anjing',   'harga' => 200000],
            ['nama' => 'Grooming Basic',       'tipe' => 'grooming',     'deskripsi' => 'Mandi, potong kuku, bersihkan telinga', 'harga' => 100000],
            ['nama' => 'Grooming Full',        'tipe' => 'grooming',     'deskripsi' => 'Grooming lengkap termasuk potong rambut', 'harga' => 250000],
            ['nama' => 'Pemeriksaan Umum',     'tipe' => 'pemeriksaan',  'deskripsi' => 'Pemeriksaan kesehatan umum',        'harga' => 80000],
            ['nama' => 'Pemeriksaan Lanjutan', 'tipe' => 'pemeriksaan',  'deskripsi' => 'Pemeriksaan mendalam + lab',        'harga' => 300000],
        ];

        foreach ($treatments as $t) {
            Treatment::create($t);
        }
    }
}
