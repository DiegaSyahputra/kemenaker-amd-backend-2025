@extends('layouts.app')

@section('title', 'Detail Pemilik')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('owners.index') }}">Pemilik</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div
                        style="width:70px;height:70px;background:#e8f5ee;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 16px">
                        👤</div>
                    <h5 class="fw-bold">{{ $owner->nama }}</h5>
                    <p class="text-muted mb-1">{{ $owner->no_telp }}</p>
                    @if ($owner->verifikasi_no_telp)
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3">
                            <i class="bi bi-check-circle-fill me-1"></i>Terverifikasi
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 mb-3">
                            <i class="bi bi-x-circle-fill me-1"></i>Belum Verifikasi
                        </span>
                    @endif
                    <div class="text-start mt-3 pt-3 border-top">
                        <div class="mb-2 d-flex gap-2">
                            <i class="bi bi-envelope text-muted"></i>
                            <span class="text-muted small">{{ $owner->email ?? 'Tidak ada email' }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <i class="bi bi-geo-alt text-muted"></i>
                            <span class="text-muted small">{{ $owner->alamat ?? 'Tidak ada alamat' }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('owners.edit', $owner) }}" class="btn btn-warning btn-sm flex-fill">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('owners.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Hewan Peliharaan ({{ $owner->pets->count() }})</span>
                    <a href="{{ route('pets.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Hewan
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Hewan</th>
                                <th>Kode</th>
                                <th>Usia</th>
                                <th>Berat</th>
                                <th>Pemeriksaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($owner->pets as $pet)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">{{ $pet->nama }}</span>
                                        <br><small class="text-muted">{{ $pet->jenis }}</small>
                                    </td>
                                    <td><span class="reg-code">{{ $pet->kode_registrasi }}</span></td>
                                    <td>{{ $pet->usia }} thn</td>
                                    <td>{{ $pet->berat }} kg</td>
                                    <td><span class="badge bg-secondary">{{ $pet->checkups->count() }}x</span></td>
                                    <td>
                                        <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada hewan terdaftar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
