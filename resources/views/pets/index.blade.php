@extends('layouts.app')

@section('title', 'Data Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Hewan</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span>Daftar Hewan Peliharaan</span>
            <a href="{{ route('pets.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Daftarkan Hewan
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Kode Registrasi</th>
                        <th>Nama & Jenis</th>
                        <th>Pemilik</th>
                        <th>Usia</th>
                        <th>Berat</th>
                        <th>Pemeriksaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $i => $pet)
                        <tr>
                            <td class="ps-4">{{ $pets->firstItem() + $i }}</td>
                            <td><span class="reg-code">{{ $pet->kode_registrasi }}</span></td>
                            <td>
                                <span class="fw-semibold">{{ $pet->nama }}</span>
                                <br><small class="text-muted">{{ $pet->jenis }}</small>
                            </td>
                            <td>{{ $pet->owner->nama }}</td>
                            <td>{{ $pet->usia }} thn</td>
                            <td>{{ $pet->berat }} Kg</td>
                            <td>
                                <span class="badge bg-secondary rounded-pill">{{ $pet->checkups_count ?? 0 }}x</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pets.edit', $pet) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pets.destroy', $pet) }}" method="POST"
                                        onsubmit="return confirm('Hapus data hewan ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data hewan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pets->hasPages())
            <div class="card-footer bg-white">{{ $pets->links() }}</div>
        @endif
    </div>
@endsection
