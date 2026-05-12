@extends('layouts.app')

@section('title', 'Detail Pemeriksaan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('checkups.index') }}">Pemeriksaan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Detail Pemeriksaan</span>
                    <span class="badge badge-{{ $checkup->treatment->tipe }} rounded-pill px-3 py-2">
                        {{ ucfirst($checkup->treatment->tipe) }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:16px">
                                <div class="small text-muted mb-1">Hewan</div>
                                <div class="fw-bold">{{ $checkup->pet->nama }}</div>
                                <div class="small text-muted">{{ $checkup->pet->jenis }}</div>
                                <div class="small text-muted mt-1">
                                    Kode: <span class="reg-code">{{ $checkup->pet->kode_registrasi }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:16px">
                                <div class="small text-muted mb-1">Pemilik</div>
                                <div class="fw-bold">{{ $checkup->pet->owner->nama }}</div>
                                <div class="small text-muted">{{ $checkup->pet->owner->no_telp }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:16px">
                                <div class="small text-muted mb-1">Perawatan</div>
                                <div class="fw-bold">{{ $checkup->treatment->nama }}</div>
                                <div class="small text-muted">Rp
                                    {{ number_format($checkup->treatment->harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="background:#f8f9fa;border-radius:10px;padding:16px">
                                <div class="small text-muted mb-1">Tanggal</div>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($checkup->tgl_checkup)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        @if ($checkup->catatan)
                            <div class="col-12">
                                <div style="background:#f8f9fa;border-radius:10px;padding:16px">
                                    <div class="small text-muted mb-1">📝 Catatan</div>
                                    <div>{{ $checkup->catatan }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('checkups.edit', $checkup) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('checkups.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <form action="{{ route('checkups.destroy', $checkup) }}" method="POST" class="ms-auto"
                            onsubmit="return confirm('Hapus data pemeriksaan ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
