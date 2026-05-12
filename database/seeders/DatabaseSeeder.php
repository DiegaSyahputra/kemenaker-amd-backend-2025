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
        // Owners
        $owners = [
            ['nama' => 'Budi Santoso',   'no_telp' => '081234567890', 'verifikasi_no_telp' => true,  'email' => 'budi@gmail.com',   'alamat' => 'Jl. Mawar No. 1, Jember'],
            ['nama' => 'Siti Rahayu',    'no_telp' => '082345678901', 'verifikasi_no_telp' => true,  'email' => 'siti@gmail.com',   'alamat' => 'Jl. Melati No. 5, Jember'],
            ['nama' => 'Agus Wijaya',    'no_telp' => '083456789012', 'verifikasi_no_telp' => false, 'email' => 'agus@gmail.com',   'alamat' => 'Jl. Kenanga No. 3, Jember'],
            ['nama' => 'Dewi Kusuma',    'no_telp' => '084567890123', 'verifikasi_no_telp' => true,  'email' => 'dewi@gmail.com',   'alamat' => 'Jl. Dahlia No. 7, Jember'],
            ['nama' => 'Rizky Pratama',  'no_telp' => '085678901234', 'verifikasi_no_telp' => false, 'email' => 'rizky@gmail.com',  'alamat' => 'Jl. Anggrek No. 2, Jember'],
        ];

        foreach ($owners as $o) {
            Owner::create($o);
        }

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

        // Pets
        $pets = [
            ['owner_id' => 1, 'nama' => 'MILO',   'jenis' => 'KUCING', 'usia' => 2,   'berat' => 4.5],
            ['owner_id' => 1, 'nama' => 'CLEO',   'jenis' => 'ANJING', 'usia' => 3,   'berat' => 8.0],
            ['owner_id' => 2, 'nama' => 'BUDDY',  'jenis' => 'ANJING', 'usia' => 1,   'berat' => 5.2],
            ['owner_id' => 4, 'nama' => 'LUNA',   'jenis' => 'KUCING', 'usia' => 4,   'berat' => 3.8],
        ];

        foreach ($pets as $p) {
            $kode = Pet::generateKodeRegistrasi($p['owner_id']);
            Pet::create(array_merge($p, ['kode_registrasi' => $kode]));
        }

        // Checkups
        $checkupData = [
            ['pet_id' => 1, 'treatment_id' => 1, 'tgl_checkup' => '2024-01-10', 'catatan' => 'Kondisi baik'],
            ['pet_id' => 1, 'treatment_id' => 5, 'tgl_checkup' => '2024-02-15', 'catatan' => 'Sedikit pilek'],
            ['pet_id' => 2, 'treatment_id' => 3, 'tgl_checkup' => '2024-01-20', 'catatan' => 'Grooming rutin'],
            ['pet_id' => 3, 'treatment_id' => 2, 'tgl_checkup' => '2024-03-05', 'catatan' => 'Vaksin tahunan'],
            ['pet_id' => 4, 'treatment_id' => 5, 'tgl_checkup' => '2024-03-10', 'catatan' => 'Pemeriksaan rutin'],
            ['pet_id' => 5, 'treatment_id' => 6, 'tgl_checkup' => '2024-03-12', 'catatan' => 'Pemeriksaan lanjutan'],
        ];

        foreach ($checkupData as $c) {
            Checkup::create($c);
        }
    }
}
