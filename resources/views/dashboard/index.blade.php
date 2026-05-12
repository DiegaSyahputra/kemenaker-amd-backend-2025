@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box" style="background:#e8f5ee">🧑‍🤝‍🧑</div>
                </div>
                <div class="stat-number">{{ $stats['total_owners'] }}</div>
                <div class="stat-label">Total Pemilik</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box" style="background:#fff3cd">🐾</div>
                </div>
                <div class="stat-number">{{ $stats['total_pets'] }}</div>
                <div class="stat-label">Total Hewan</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box" style="background:#cfe2ff">🩺</div>
                </div>
                <div class="stat-number">{{ $stats['total_checkups'] }}</div>
                <div class="stat-label">Total Pemeriksaan</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="icon-box" style="background:#f8d7da">💉</div>
                </div>
                <div class="stat-number">{{ $stats['total_treatments'] }}</div>
                <div class="stat-label">Jenis Perawatan</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Recent Checkups -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Pemeriksaan Terbaru</span>
                    <a href="{{ route('checkups.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Hewan</th>
                                <th>Pemilik</th>
                                <th>Perawatan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCheckups as $c)
                                <tr>
                                    <td class="ps-4">
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
                                    <td>{{ \Carbon\Carbon::parse($c->tgl_checkup)->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada pemeriksaan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Pets -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Hewan Terbaru</span>
                    <a href="{{ route('pets.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Hewan</th>
                                <th>Kode</th>
                                <th>Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPets as $p)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">{{ $p->nama }}</span>
                                        <br><small class="text-muted">{{ $p->jenis }}</small>
                                    </td>
                                    <td><span class="reg-code">{{ $p->kode_registrasi }}</span></td>
                                    <td>{{ $p->owner->nama }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada data hewan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
