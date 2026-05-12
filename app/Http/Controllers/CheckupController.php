<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Checkups;
use App\Models\Pet;
use App\Models\Treatment;
use Illuminate\Http\Request;

class CheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkups = Checkup::with('pet.owner','treatment')->paginate(10);
        return view('checkups.index', compact('checkups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pets       = Pet::with('owner')->orderBy('nama')->get();
        $treatments = Treatment::orderBy('tipe')->get();
        return view('checkups.create', compact('pets', 'treatments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pet_id'            => 'required|exists:pets,id',
            'treatment_id'      => 'required|exists:treatments,id',
            'tgl_checkup'      => 'required|date',
            'catatan'             => 'nullable|string',
        ], [
            'pet_id.required'       => 'Hewan wajib dipilih.',
            'treatment_id.required' => 'Jenis perawatan wajib dipilih.',
            'tgl_checkup.required' => 'Tanggal pemeriksaan wajib diisi.',
        ]);

        Checkup::create($request->all());

        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkup $checkup)
    {
        $checkup->load(['pet.owner', 'treatment']);
        return view('checkups.show', compact('checkup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checkup $checkup)
    {
        $pets       = Pet::with('owner')->orderBy('nama')->get();
        $treatments = Treatment::orderBy('tipe')->get();
        return view('checkups.edit', compact('checkup', 'pets', 'treatments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Checkup $checkup)
    {
        $request->validate([
            'pet_id'            => 'required|exists:pets,id',
            'treatment_id'      => 'required|exists:treatments,id',
            'tgl_checkup'      => 'required|date',
            'catatan'             => 'nullable|string',
        ]);

        $checkup->update($request->all());

        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil diupdate!');
    }

    public function destroy(Checkup $checkup)
    {
        $checkup->delete();
        return redirect()->route('checkups.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus!');
    }
}
