<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rekam Medis | Dokter</title>

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT (IDENTIK DASHBOARD DOKTER)
        ====================================================== */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(180deg,#ffffff 0%,#fff7ef 20%,#ffe6bf 50%,#ffcf86 80%,#ffb74a 100%);
            background-attachment: fixed;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at bottom, rgba(255,170,40,0.22), transparent 60%);
            pointer-events: none;
            z-index: -1;
        }

        /* ================= NAVBAR (COPY DASHBOARD DOKTER) ================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: linear-gradient(135deg,#102f76 0%,#142a46 100%);
            color: #ffffff;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }
        .nav-left { display:flex; align-items:center; gap:12px; }
        .nav-logo {
            font-size: 30px;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }
        .brand-text-title { font-weight:700; font-size:18px; }
        .brand-text-sub { font-size:12px; opacity:.8; }

        .nav-center { flex:1; display:flex; justify-content:center; padding:0 40px; }
        .nav-search {
            display:flex; align-items:center; gap:8px;
            background: #ffffff; border-radius:999px;
            padding:6px 14px; min-width:280px; max-width:420px;
            box-shadow:0 4px 10px rgba(0,0,0,0.15);
        }
        .nav-search input {
            border:none; outline:none; flex:1; font-size:13px;
        }

        .nav-right { display:flex; align-items:center; gap:16px; }
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f9a01b;
            color: #102f76;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
            flex-shrink: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.1;
        }

        .user-role {
            font-size: 12px;
            opacity: .8;
            line-height: 1.1;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-name { font-size:13px; font-weight:600; }
        .user-role { font-size:11px; opacity:.8; }
        .btn-logout {
            padding:7px 14px; border-radius:999px;
            background:#f5594b; color:white; text-decoration:none;
            font-size:12px; font-weight:600;
            box-shadow:0 4px 12px rgba(245,89,75,0.5);
        }

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            width: 215px;
            border-radius: 24px;
            background: linear-gradient(180deg, #102f76 0%, #142a46 100%);
            color: #fff;
            box-shadow: 0 18px 38px rgba(0,0,0,0.35);
            padding: 26px 22px 20px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            padding: 0;
            border-radius: 12px;
            transition: 0.25s ease;
        }

        .sidebar-header:hover {
            background: rgba(255,255,255,0.08);
        }

        .sidebar-header-icon {
            width: 42px;
            height: 42px;
            border-radius: 18px;
            background: rgba(250, 177, 64, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-header-title {
            display: flex;
            flex-direction: column;
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-header-sub {
            font-size: 12px;
            opacity: .8;
            font-weight: 500;
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.18);
            margin: 8px 0 6px;
        }

        .sidebar-section-title {
            font-size: 11px;
            letter-spacing: 1px;
            font-weight: 700;
            text-transform: uppercase;
            color: rgba(255,255,255,0.65);
            margin-top: 6px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 12px;
            color: #e9f1ff;
            font-size: 14px;
            transition: 0.25s ease;
            text-decoration: none;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.10);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            background: rgba(18,25,55,0.85);
            box-shadow: 0 10px 24px rgba(0,0,0,0.45);
        }

        .sidebar-bottom {
            margin-top: auto;
            font-size: 11px;
            opacity: .7;
            text-align: center;
            padding-top: 8px;
        }

        /* ================= CONTENT WRAPPER ================= */
        .content {
            flex:1;
            background:rgba(255,255,255,0.78);
            backdrop-filter:blur(16px);
            border-radius:20px;
            padding:32px 36px 40px;
            box-shadow:0 12px 35px rgba(0,0,0,0.15);
            animation:fadeIn .45s ease;
        }
        @keyframes fadeIn {
            from{opacity:0; transform:translateY(15px);}
            to{opacity:1; transform:translateY(0);}
        }

        /* ================= PAGE HEADER (COPY DATA PASIEN) ================= */
        .page-header { text-align:center; margin-bottom:20px; }
        .page-header-icon {
            font-size:54px; color:#102f76;
            background:#f9a01b33;
            padding:20px; border-radius:50%;
            display:inline-block;
        }
        .page-header h1 {
            margin-top:18px;
            font-size:34px; color:#102f76; font-weight:800;
        }

        /* ================= TABLE ================= */
        table {
            width:100%; border-collapse:collapse;
            border-radius:14px; overflow:hidden;
            margin-top:26px;
            box-shadow:0 10px 26px rgba(0,0,0,0.10);
        }
        th {
            background:linear-gradient(135deg,#102f76,#142a46);
            color:#f9a01b; padding:15px; font-size:16px;
        }
        td {
            background:rgba(255,255,255,0.82);
            padding:14px; border-bottom:1px solid rgba(0,0,0,0.05);
            text-align:center; font-size:15px;
        }
        tr:hover td { background:rgba(249,160,27,0.13); }

        /* BUTTONS */
        .btn-detail {
            padding:7px 14px; border-radius:999px;
            background:#f9a01b; color:#102f76;
            text-decoration:none; font-weight:700;
            box-shadow:0 4px 12px rgba(249,160,27,0.35);
            display:inline-flex; gap:6px; align-items:center;
        }
        .btn-detail:hover {
            transform:translateY(-2px);
        }

    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Dokter');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Dokter</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari rekam medis...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ route('dokter.profile') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; transition: opacity 0.2s;">
            <div class="user-info">
                <div class="user-avatar">{{ $initial }}</div>
                <div>
                    <div class="user-name">{{ $displayName }}</div>
                    <div class="user-role">{{ $displayRole }}</div>
                </div>
            </div>
        </a>
        <a href="{{ route('logout') }}" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<!-- ================= LAYOUT ================= -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="{{ route('interface.dashboard_dokter') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Dashboard Dokter</div>
                    <div class="sidebar-header-sub">Panel Dokter Klinik</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Menu Utama</div>
        <div class="sidebar-menu">
            <a href="{{ route('interface.dashboard_dokter') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">Manajemen</div>
        <div class="sidebar-menu">
            <a href="{{ route('dokter.rekammedis.index') }}" class="sidebar-link active">
                <i class="bi bi-journal-medical"></i> <span>Data Rekam Medis</span>
            </a>

            <a href="{{ route('dokter.pasien.index') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i> <span>Data Pasien</span>
            </a>

            <a href="{{ route('dokter.jadwal.index') }}" class="sidebar-link">
                <i class="bi bi-calendar-check"></i> <span>Jadwal Pemeriksaan</span>
            </a>

            <a href="{{ route('dokter.jenishewan.index') }}" class="sidebar-link">
                <i class="bi bi-bug"></i> <span>Data Jenis Hewan</span>
            </a>

            <a href="{{ route('dokter.rashewan.index') }}" class="sidebar-link">
                <i class="bi bi-bug-fill"></i> <span>Data Ras Hewan</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="content">

        <div class="page-header">
            <i class="bi bi-clipboard2-pulse page-header-icon"></i>
            <h1>Data Rekam Medis</h1>
            <p>Riwayat pemeriksaan hewan oleh dokter.</p>
        </div>

        <!-- TABLE -->
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>ID Reservasi</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Nama Hewan</th>
                <th>Jenis Hewan</th>
                <th>Ras</th>
                <th>Kelamin</th>
                <th>Usia</th>
                <th>Pemilik</th>
                <th>Dokter Pemeriksa</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($rekamMedis as $index => $rm)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rm->idreservasi }}</td>

                    <!-- Tanggal & Waktu -->
                    <td>{{ \Carbon\Carbon::parse($rm->tanggal_temu)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($rm->waktu_temu)->format('H:i') }}</td>

                    <!-- Hewan -->
                    <td>{{ $rm->nama_hewan ?? '-' }}</td>
                    <td>{{ $rm->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $rm->nama_ras ?? '-' }}</td>
                    <td>{{ $rm->jenis_kelamin ?? '-' }}</td>

                    <!-- Usia -->
                    <td>{{ $rm->usia ? $rm->usia . ' bulan' : '-' }}</td>

                    <!-- Pemilik -->
                    <td>{{ $rm->nama_pemilik ?? '-' }}</td>

                    <!-- Dokter Pemeriksa -->
                    <td>{{ $rm->nama_dokter ?? '-' }}</td>

                    <!-- Aksi -->
                    <td>
                        <a href="{{ route('dokter.rekammedis.detail',$rm->idtemu_dokter) }}" class="btn-detail">
                            <i class="bi bi-info-circle"></i> Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align:center;color:#555;">Belum ada data rekam medis.</td>
                </tr>
            @endforelse
            </tbody>
        </table>


    </div><!-- content -->
</div><!-- layout -->

</body>
</html>
