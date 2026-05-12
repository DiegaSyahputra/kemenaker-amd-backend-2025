@extends('layouts.app')

@section('title', 'Edit Pemeriksaan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('checkups.index') }}">Pemeriksaan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pencil me-2 text-warning"></i>Edit Data Pemeriksaan
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

                    <form action="{{ route('checkups.update', $checkup) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Hewan <span class="text-danger">*</span></label>
                            <select name="pet_id" class="form-select @error('pet_id') is-invalid @enderror">
                                @foreach ($pets as $pet)
                                    <option value="{{ $pet->id }}"
                                        {{ old('pet_id', $checkup->pet_id) == $pet->id ? 'selected' : '' }}>
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
                                @foreach ($treatments->groupBy('tipe') as $tipe => $group)
                                    <optgroup label="{{ ucfirst($tipe) }}">
                                        @foreach ($group as $t)
                                            <option value="{{ $t->id }}"
                                                {{ old('treatment_id', $checkup->treatment_id) == $t->id ? 'selected' : '' }}>
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
                            <input type="date" name="tgl_checkup" class="form-control"
                                value="{{ old('tgl_checkup', $checkup->tgl_checkup) }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $checkup->catatan) }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-lg me-1"></i> Update
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
