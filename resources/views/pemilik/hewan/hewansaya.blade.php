<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hewan Saya | Pemilik</title>

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT ELEGANT ORANGE SOFT
        ====================================================== */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(
                180deg,
                #ffffff 0%,
                #fff7ef 20%,
                #ffe6bf 50%,
                #ffcf86 80%,
                #ffb74a 100%
            );
            background-attachment: fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(
                circle at bottom,
                rgba(255,170,40,0.22),
                transparent 60%
            );
            pointer-events: none;
            z-index: -1;
        }

        /* ================= NAVBAR (TOP) – SAMA PALET ================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            color: #ffffff;
            padding: 14px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-logo {
            font-size: 30px;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }

        .brand-text-title {
            font-weight: 700;
            font-size: 18px;
        }

        .brand-text-sub {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-center {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 0 40px;
        }

        .nav-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            border-radius: 999px;
            padding: 6px 14px;
            min-width: 280px;
            max-width: 420px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .nav-search i {
            color: #102f76;
            font-size: 16px;
        }

        .nav-search input {
            border: none;
            outline: none;
            font-size: 13px;
            width: 100%;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #f9a01b;
            color: #102f76;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            font-size: 11px;
            opacity: 0.8;
        }

        .btn-logout {
            padding: 7px 14px;
            border-radius: 999px;
            border: none;
            background: #f5594b;
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(245,89,75,0.5);
        }

        .btn-logout:hover {
            filter: brightness(1.05);
        }

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR (SETEMA DENGAN HALAMAN LAIN) ---------- */
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

        /* ---------- MAIN AREA ---------- */
        .main-area {
            flex: 1;
        }

        .content {
            background: rgba(255,255,255,0.86);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 28px 30px 34px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.45s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ================= PAGE HEADER ================= */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .page-title-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .page-icon-circle {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(249,160,27,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #f9a01b;
        }

        .page-title-texts {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #102f76;
        }

        .page-subtitle {
            font-size: 13px;
            color: #555;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 16px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

        th {
            background: linear-gradient(135deg, #102f76, #142a46);
            color: #f9a01b;
            padding: 15px;
            text-align: left;
            font-weight: 700;
            font-size: 14px;
        }

        td {
            padding: 14px;
            background: rgba(255,255,255,0.95);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-size: 14px;
            color: #333;
        }

        tr:hover td {
            background: rgba(249,160,27,0.13);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 1100px) {
            .layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }
            .sidebar-menu {
                flex-direction: row;
                flex-wrap: nowrap;
            }
            .sidebar-section-title {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .content {
                padding: 22px 18px 26px;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            table {
                font-size: 12px;
            }
            th, td {
                padding: 10px 8px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'Pemilik';
    $displayRole = 'Pemilik Hewan';
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Hewan Peliharaan</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari menu atau informasi...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ route('pemilik.profile') }}" style="text-decoration:none; color:inherit;">
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

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="{{ route('dashboard.pemilik') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Dashboard</div>
                    <div class="sidebar-header-sub">Ringkasan akun Anda</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Menu Pemilik</div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard.pemilik') }}" class="sidebar-link">
                <i class="bi bi-house-door-fill"></i> <span>Beranda</span>
            </a>
            <a href="{{ route('pemilik.hewan.index') }}" class="sidebar-link active">
                <i class="bi bi-heart-fill"></i> <span>Hewan Saya</span>
            </a>
            <a href="{{ route('pemilik.temudokter.index') }}" class="sidebar-link">
                <i class="bi bi-calendar-check"></i> <span>Jadwal Temu Dokter</span>
            </a>
            <a href="{{ route('pemilik.kunjungan.index') }}" class="sidebar-link">
                <i class="bi bi-journal-medical"></i> <span>Riwayat Kunjungan</span>
            </a>
            <a href="{{ route('pemilik.rekammedis.index') }}" class="sidebar-link">
                <i class="bi bi-file-medical"></i> <span>Rekam Medis</span>
            </a>
            <a href="{{ route('pemilik.profile') }}" class="sidebar-link">
                <i class="bi bi-person-circle"></i> <span>Profil</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">
        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div class="page-title-group">
                    <div class="page-icon-circle">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div class="page-title-texts">
                        <div class="page-title">Hewan Peliharaan Saya</div>
                        <div class="page-subtitle">
                            Daftar hewan yang terdaftar atas nama Anda di klinik.
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pet</th>
                        <th>Jenis Hewan</th>
                        <th>Ras</th>
                        <th>Umur</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($hewanSaya as $index => $h)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $h->nama }}</td>
                        <td>{{ $h->nama_jenis_hewan }}</td>
                        <td>{{ $h->nama_ras }}</td>
                        <td>{{ $h->umur }} bln</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:20px; color:#777;">
                            Belum ada hewan terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div><!-- /content -->
    </div><!-- /main-area -->

</div><!-- /layout -->

</body>
</html>