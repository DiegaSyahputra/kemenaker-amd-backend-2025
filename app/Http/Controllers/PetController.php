<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;
use App\Models\Pets;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('owner')->withCount('checkups')->latest()->paginate(10);
        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Owner::where('verifikasi_no_telp', true)->orderBy('nama')->get();
        return view('pets.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id'  => 'required|exists:owners,id',
            'pet_input' => 'required|string',
        ], [
            'owner_id.required'  => 'Pemilik wajib dipilih.',
            'owner_id.exists'    => 'Pemilik tidak valid.',
            'pet_input.required' => 'Data hewan wajib diisi.',
        ]);

        // Parse input hewan
        try {
            $parsed = $this->parsePetInput($request->pet_input);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['pet_input' => $e->getMessage()]);
        }

        // Cek duplikasi: nama + jenis + owner yang sama
        $duplikat = Pet::where('owner_id', $request->owner_id)
            ->where('nama', $parsed['nama'])
            ->where('jenis', $parsed['jenis'])
            ->exists();

        if ($duplikat) {
            return back()
                ->withInput()
                ->withErrors(['pet_input' => 'Hewan dengan nama dan jenis yang sama sudah dimiliki oleh pemilik ini.']);
        }

        // Generate kode registrasi
        $kode = Pet::generateKodeRegistrasi($request->owner_id);

        Pet::create([
            'kode_registrasi' => $kode,
            'owner_id'          => $request->owner_id,
            'nama'              => $parsed['nama'],
            'jenis'           => $parsed['jenis'],
            'usia'               => $parsed['usia'],
            'berat'            => $parsed['berat'],
        ]);

        return redirect()->route('pets.index')
            ->with('success', "Hewan {$parsed['nama']} berhasil didaftarkan dengan kode {$kode}!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        $pet->load(['owner', 'checkups.treatment']);
        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $owners = Owner::where('verifikasi_no_telp', true)->orderBy('nama')->get();
        return view('pets.edit', compact('pet', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'owner_id'  => 'required|exists:owners,id',
            'pet_input' => 'required|string',
        ]);

        try {
            $parsed = $this->parsePetInput($request->pet_input);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['pet_input' => $e->getMessage()]);
        }

        // Cek duplikasi kecuali diri sendiri
        $duplikat = Pet::where('owner_id', $request->owner_id)
            ->where('nama', $parsed['nama'])
            ->where('jenis', $parsed['jenis'])
            ->where('id', '!=', $pet->id)
            ->exists();

        if ($duplikat) {
            return back()->withInput()->withErrors(['pet_input' => 'Hewan dengan nama dan jenis yang sama sudah dimiliki oleh pemilik ini.']);
        }

        $pet->update([
            'owner_id' => $request->owner_id,
            'nama'     => $parsed['nama'],
            'jenis'  => $parsed['jenis'],
            'usia'      => $parsed['usia'],
            'berat'   => $parsed['berat'],
        ]);

        return redirect()->route('pets.index')
            ->with('success', 'Data hewan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index')
            ->with('success', 'Data hewan berhasil dihapus!');
    }

    private function parsePetInput(string $input): array
    {
        // Bersihkan spasi berlebih
        $input = trim(preg_replace('/\s+/', ' ', $input));

        // Pecah berdasarkan spasi
        $parts = explode(' ', $input);

        if (count($parts) < 4) {
            throw new \Exception('Format input tidak valid. Gunakan format: NAMA JENIS USIA BERAT. Contoh: Milo Kucing 2Th 4.5kg');
        }

        // Nama hewan = bagian pertama
        $nama = strtoupper($parts[0]);

        // Jenis hewan = bagian kedua
        $jenis = strtoupper($parts[1]);

        // Usia = bagian ketiga - bersihkan satuan
        $usiaMentah = $parts[2];
        $usia    = $this->parseAge($usiaMentah);

        // Berat = bagian keempat - bersihkan satuan
        $beratMentah = $parts[3];
        $berat    = $this->parseWeight($beratMentah);

        return [
            'nama'    => $nama,
            'jenis' => $jenis,
            'usia'     => $usia,
            'berat'  => $berat,
        ];
    }

    /**
     * Parse usia dari berbagai format:
     * 2tahun, 2thn, 2th, 2Tahun, 2TH, 2 tahun, dll
     */
    private function parseAge(string $raw): float
    {
        // Hapus semua huruf (tahun, thn, th, dll) - case insensitive
        $clean = preg_replace('/[a-zA-Z]/i', '', $raw);
        $clean = trim($clean);

        if (!is_numeric($clean) || (int)$clean < 0) {
            throw new \Exception("Format usia tidak valid: '{$raw}'. Contoh: 2Th, 2tahun, 2thn");
        }

        return (int)$clean;
    }

    /**
     * Parse berat dari berbagai format:
     * 4.5kg, 4,5kg, 4.5 KG, 4,5KG, dll
     */
    private function parseWeight(string $raw): float
    {
        // Hapus semua huruf (kg, KG, dll)
        $clean = preg_replace('/[a-zA-Z]/i', '', $raw);
        // Ganti koma dengan titik (format desimal Indonesia)
        $clean = str_replace(',', '.', $clean);
        $clean = trim($clean);

        if (!is_numeric($clean) || (float)$clean <= 0) {
            throw new \Exception("Format berat tidak valid: '{$raw}'. Contoh: 4.5kg, 4,5kg");
        }

        return (float)$clean;
    }
}
