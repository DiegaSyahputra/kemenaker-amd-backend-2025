@extends('layouts.app')

@section('title', 'Data Pemilik')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pemilik</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>Daftar Pemilik Hewan</span>
        <a href="{{ route('owners.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pemilik
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="ps-4" style="width:40px">#</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Jumlah Hewan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($owners as $i => $owner)
                <tr>
                    <td class="ps-4">{{ $owners->firstItem() + $i }}</td>
                    <td class="fw-semibold">{{ $owner->nama }}</td>
                    <td>{{ $owner->no_telp }}</td>
                    <td>
                        @if($owner->verifikasi_no_telp)
                            <span class="badge bg-success-subtle text-success rounded-pill px-2">
                                <i class="bi bi-check-circle-fill me-1"></i>Terverifikasi
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-2">
                                <i class="bi bi-x-circle-fill me-1"></i>Belum Verifikasi
                            </span>
                        @endif
                    </td>
                    <td>{{ $owner->email ?? '-' }}</td>
                    <td>
                        <span class="badge bg-secondary rounded-pill">{{ $owner->pets_count }} hewan</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('owners.show', $owner) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('owners.edit', $owner) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('owners.destroy', $owner) }}" method="POST"
                                  onsubmit="return confirm('Hapus pemilik ini? Semua data hewan terkait juga akan terhapus!')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada data pemilik
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($owners->hasPages())
    <div class="card-footer bg-white">
        {{ $owners->links() }}
    </div>
    @endif
</div>
@endsection
