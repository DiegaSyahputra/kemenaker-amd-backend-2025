<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Owners;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::withCount('pets')->paginate(10);
        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'no_telp'   => 'required|string|unique:owners,no_telp',
            'email' => 'nullable|email',
            'alamat' => 'nullable|string',
        ], [
            'nama.required'    => 'Nama pemilik wajib diisi.',
            'no_telp.required'   => 'Nomor telepon wajib diisi.',
            'no_telp.unique'     => 'Nomor telepon sudah terdaftar.',
            'email.email'      => 'Format email tidak valid.',
        ]);

        Owner::create([
            'nama'           => $request->nama,
            'no_telp'          => $request->no_telp,
            'verifikasi_no_telp' => $request->has('verifikasi_no_telp'),
            'email'        => $request->email,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('owners.index')
            ->with('success', 'Pemilik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        $owner->load(['pets.checkups.treatment']);
        return view('owners.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'no_telp'   => 'required|string|unique:owners,no_telp,' . $owner->id,
            'email'   => 'nullable|email',
            'alamat' => 'nullable|string',
        ]);

        $owner->update([
            'nama'           => $request->nama,
            'no_telp'          => $request->no_telp,
            'verifikasi_no_telp' => $request->has('verifikasi_no_telp'),
            'email'        => $request->email,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('owners.index')
            ->with('success', 'Data pemilik berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('owners.index')
            ->with('success', 'Pemilik berhasil dihapus!');
    }
}
