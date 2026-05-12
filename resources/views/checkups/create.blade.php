@extends('layouts.app')

@section('title', 'Tambah Pemeriksaan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('checkups.index') }}">Pemeriksaan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-clipboard2-plus me-2 text-success"></i>Form Tambah Pemeriksaan
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkups.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Hewan <span class="text-danger">*</span></label>
                            <select name="pet_id" class="form-select @error('pet_id') is-invalid @enderror">
                                <option value="">-- Pilih Hewan --</option>
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                        {{ $pet->nama }} ({{ $pet->jenis }}) — {{ $pet->owner->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pet_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Perawatan <span class="text-danger">*</span></label>
                            <select name="treatment_id" class="form-select @error('treatment_id') is-invalid @enderror">
                                <option value="">-- Pilih Perawatan --</option>
                                @foreach ($treatments->groupBy('tipe') as $tipe => $group)
                                    <optgroup label="{{ ucfirst($tipe) }}">
                                        @foreach ($group as $t)
                                            <option value="{{ $t->id }}"
                                                {{ old('treatment_id') == $t->id ? 'selected' : '' }}>
                                                {{ $t->nama }} — Rp {{ number_format($t->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('treatment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_checkup"
                                class="form-control @error('tgl_checkup') is-invalid @enderror"
                                value="{{ old('tgl_checkup', date('Y-m-d')) }}">
                            @error('tgl_checkup')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan kondisi hewan...">{{ old('catatan') }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Simpan
                            </button>
                            <a href="{{ route('checkups.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
