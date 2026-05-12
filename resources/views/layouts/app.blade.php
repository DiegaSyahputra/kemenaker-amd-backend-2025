<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Hewan - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary: #1a6b3a;
            --primary-dark: #134f2c;
            --primary-light: #e8f5ee;
            --accent: #f0a500;
        }

        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--primary-dark);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
        }

        .sidebar-brand {
            padding: 20px 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1rem;
        }

        .sidebar-brand small {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
        }

        .nav-section-label {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 16px 20px 6px;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 10px 20px;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            border-left-color: var(--accent);
        }

        .sidebar .nav-link i {
            font-size: 1rem;
            width: 20px;
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            padding: 14px 24px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .topbar h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a1a2e;
        }

        .topbar .breadcrumb {
            margin: 0;
            font-size: 0.8rem;
        }

        .content-area {
            padding: 24px;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .stat-card .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .stat-card .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 16px 20px;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
        }

        /* Table */
        .table th {
            background: #f8f9fa;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: none;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.88rem;
        }

        /* Badges */
        .badge-vaksin {
            background: #cfe2ff;
            color: #084298;
        }

        .badge-grooming {
            background: #d1e7dd;
            color: #0a3622;
        }

        .badge-pemeriksaan {
            background: #fff3cd;
            color: #664d03;
        }

        /* Forms */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 0.88rem;
            padding: 10px 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 107, 58, 0.15);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn {
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Alert */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.88rem;
        }

        /* Code badge */
        .reg-code {
            font-family: monospace;
            background: #f0f0f0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.82rem;
            color: #495057;
        }

        /* Verified badge */
        .verified-badge {
            color: #198754;
        }

        .unverified-badge {
            color: #dc3545;
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="logo-icon">🐾</div>
            <h5>PetCare+</h5>
            <small>Klinik Hewan</small>
        </div>

        <div class="nav-section-label">Menu Utama</div>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </nav>

        <div class="nav-section-label">Data Master</div>
        <nav class="nav flex-column">
            <a href="{{ route('owners.index') }}" class="nav-link {{ request()->routeIs('owners.*') ? 'active' : '' }}">
                Pemilik Hewan
            </a>
            <a href="{{ route('pets.index') }}" class="nav-link {{ request()->routeIs('pets.*') ? 'active' : '' }}">
                Data Hewan
            </a>
        </nav>

        <div class="nav-section-label">Medis</div>
        <nav class="nav flex-column">
            <a href="{{ route('checkups.index') }}"
                class="nav-link {{ request()->routeIs('checkups.*') ? 'active' : '' }}">
                Pemeriksaan
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <h4>@yield('title', 'Dashboard')</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
        </div>

        <div class="content-area">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
                    role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2"
                    role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
