@extends('layouts.app')

@section('title', 'Detail Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pets.index') }}">Hewan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <div
                        style="width:70px;height:70px;background:#fff3cd;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 16px">
                        🐾</div>
                    <h5 class="fw-bold">{{ $pet->nama }}</h5>
                    <p class="text-muted mb-1">{{ $pet->jenis }}</p>
                    <span class="reg-code d-inline-block mb-3">{{ $pet->kode_registrasi }}</span>

                    <div class="row g-2 text-center mb-3">
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:8px;padding:10px">
                                <div class="fw-bold">{{ $pet->usia }} thn</div>
                                <small class="text-muted">Usia</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background:#f8f9fa;border-radius:8px;padding:10px">
                                <div class="fw-bold">{{ $pet->berat }} kg</div>
                                <small class="text-muted">Berat</small>
                            </div>
                        </div>
                    </div>

                    <div class="text-start border-top pt-3">
                        <div class="small text-muted mb-1">Pemilik</div>
                        <div class="fw-semibold">{{ $pet->owner->nama }}</div>
                        <div class="small text-muted">{{ $pet->owner->no_telp }}</div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('pets.edit', $pet) }}" class="btn btn-warning btn-sm flex-fill">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Riwayat Pemeriksaan
                        ({{ $pet->checkups->count() }})</span>
                    <a href="{{ route('checkups.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Pemeriksaan
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Perawatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pet->checkups as $c)
                                <tr>
                                    <td class="ps-4">{{ \Carbon\Carbon::parse($c->tgl_checkup)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $c->treatment->tipe }} rounded-pill px-2">
                                            {{ ucfirst($c->treatment->tipe) }}
                                        </span>
                                        <br><small class="text-muted">{{ $c->treatment->nama }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('checkups.show', $c) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat pemeriksaan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
