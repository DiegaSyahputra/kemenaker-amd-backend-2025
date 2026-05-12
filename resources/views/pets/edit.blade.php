@extends('layouts.app')

@section('title', 'Edit Data Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pets.index') }}">Hewan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card mb-3">
            <div class="card-body py-2 px-3 small">
                <strong>Kode Registrasi:</strong>
                <span class="reg-code ms-2">{{ $pet->kode_registrasi }}</span>
                <span class="text-muted ms-2">(tidak berubah saat edit)</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil me-2 text-warning"></i>Edit Data Hewan
            </div>
            <div class="card-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pets.update', $pet) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Pemilik Hewan <span class="text-danger">*</span></label>
                        <select name="owner_id" class="form-select @error('owner_id') is-invalid @enderror">
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}"
                                    {{ old('owner_id', $pet->owner_id) == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->nama }} — {{ $owner->no_telp }}
                                </option>
                            @endforeach
                        </select>
                        @error('owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Data Hewan <span class="text-danger">*</span></label>
                        <input type="text" name="pet_input"
                               class="form-control @error('pet_input') is-invalid @enderror"
                               value="{{ old('pet_input', $pet->nama . ' ' . $pet->jenis . ' ' . $pet->usia . 'Th ' . $pet->berat . 'kg') }}"
                               placeholder="Contoh: Milo Kucing 2Th 4.5kg">
                        @error('pet_input') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Format: NAMA JENIS USIA BERAT</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-lg me-1"></i> Update
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
