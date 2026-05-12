@extends('layouts.app')

@section('title', 'Daftarkan Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pets.index') }}">Hewan</a></li>
    <li class="breadcrumb-item active">Daftarkan</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header">
                    Panduan Format Input
                </div>
                <div class="card-body">
                    <p class="mb-2 small fw-semibold">Format: <code>NAMA JENIS USIA BERAT</code></p>
                    <p class="mb-2 small text-muted">Contoh input yang valid:</p>
                    <div class="d-flex flex-wrap gap-2">
                        <code class="bg-light px-2 py-1 rounded small">Milo Kucing 2Th 4.5kg</code>
                        <code class="bg-light px-2 py-1 rounded small">Buddy Anjing 3tahun 8,5KG</code>
                        <code class="bg-light px-2 py-1 rounded small">Rocky Kelinci 1thn 2.0kg</code>
                    </div>
                    <hr class="my-2">
                    <div class="row g-2 small text-muted">
                        <div class="col-6">
                            <strong>Format Usia:</strong><br>
                            2th · 2thn · 2tahun · 2Tahun · 2TH
                        </div>
                        <div class="col-6">
                            <strong>Format Berat:</strong><br>
                            4.5kg · 4,5kg · 4.5KG · 4,5 KG
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="bi bi-plus-circle me-2 text-success"></i>Form Pendaftaran Hewan
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pets.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pemilik Hewan <span class="text-danger">*</span></label>
                            <select name="owner_id" class="form-select @error('owner_id') is-invalid @enderror">
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}"
                                        {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->nama }} — {{ $owner->no_telp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('owner_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($owners->isEmpty())
                                <div class="form-text text-danger">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Belum ada pemilik terverifikasi. <a href="{{ route('owners.create') }}">Tambah pemilik
                                        dulu</a>.
                                </div>
                            @else
                                <div class="form-text text-success">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Hanya menampilkan pemilik dengan nomor telepon terverifikasi.
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Data Hewan <span class="text-danger">*</span></label>
                            <input type="text" name="pet_input"
                                class="form-control @error('pet_input') is-invalid @enderror" value="{{ old('pet_input') }}"
                                placeholder="Contoh: Milo Kucing 2Th 4.5kg">
                            @error('pet_input')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: NAMA JENIS USIA BERAT</div>
                        </div>

                        <div class="alert alert-info py-2 px-3 small mb-4">
                            <i class="bi bi-shield-check me-1"></i>
                            Kode registrasi unik akan digenerate otomatis saat data disimpan.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Daftarkan Hewan
                            </button>
                            <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
