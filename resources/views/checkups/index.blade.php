@extends('layouts.app')

@section('title', 'Data Pemeriksaan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pemeriksaan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>Daftar Pemeriksaan Hewan</span>
        <a href="{{ route('checkups.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pemeriksaan
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="ps-4">#</th>
                    <th>Tanggal</th>
                    <th>Hewan</th>
                    <th>Pemilik</th>
                    <th>Perawatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($checkups as $i => $c)
                <tr>
                    <td class="ps-4">{{ $checkups->firstItem() + $i }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->tgl_checkup)->format('d M Y') }}</td>
                    <td>
                        <span class="fw-semibold">{{ $c->pet->nama }}</span>
                        <br><small class="text-muted">{{ $c->pet->jenis }}</small>
                    </td>
                    <td>{{ $c->pet->owner->nama }}</td>
                    <td>
                        <span class="badge badge-{{ $c->treatment->tipe }} rounded-pill px-2">
                            {{ ucfirst($c->treatment->tipe) }}
                        </span>
                        <br><small class="text-muted">{{ $c->treatment->nama }}</small>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('checkups.show', $c) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('checkups.edit', $c) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('checkups.destroy', $c) }}" method="POST"
                                  onsubmit="return confirm('Hapus data pemeriksaan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada data pemeriksaan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($checkups->hasPages())
    <div class="card-footer bg-white">{{ $checkups->links() }}</div>
    @endif
</div>
@endsection
