<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat</title>

    <!-- BOOTSTRAP ICONS -->
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

        /* ================= NAVBAR (TOP) ================= */
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

        /* ---------- MAIN AREA ---------- */
        .main-area {
            flex: 1;
        }

        /* ================= CONTENT ================= */
        .content {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 32px 36px 40px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.45s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-header h2 {
            color: #102f76;
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            display: inline-block;
            padding-bottom: 6px;
            position: relative;
        }

        .page-header h2::after {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, #f9a01b, #ffbb56);
            border-radius: 20px;
        }

        .page-header p {
            margin-top: 12px;
            color: #555;
            font-size: 14px;
        }

        /* ================= CARD CONTAINER ================= */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 26px;
        }

        .card-link {
            text-decoration: none;
            display: block;
        }

        .card {
            padding: 24px 22px;
            border-radius: 18px;
            box-shadow: 0 9px 20px rgba(0,0,0,0.14);
            color: #fff;
            background: linear-gradient(135deg, #102f76 0%, #1a4494 50%, #f9a01b 100%);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(0,0,0,0.22);
        }

        .card::after {
            content: "";
            position: absolute;
            right: -50px;
            top: -50px;
            width: 130px;
            height: 130px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .card-icon {
            font-size: 42px;
            margin-bottom: 12px;
            opacity: 0.95;
        }

        /* ⭐ FONT CARD FIX */
        .card h3 {
            margin: 0 0 8px;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
        }

        .card p {
            margin: 4px 0 0;
            font-size: 13px;
            font-weight: 500;
            opacity: 0.92;
            line-height: 1.4;
        }

        /* ⭐ BUTTON DI CARD ANTRIAN / JADWAL */
        .card-button {
            margin-top: 14px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.25);
            border: 1px solid rgba(255,255,255,0.4);
            border-radius: 999px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .card-button:hover {
            background: rgba(255,255,255,0.35);
            transform: scale(1.05);
        }

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
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Perawat');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Perawat</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari menu atau data...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ route('perawat.profile') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; transition: opacity 0.2s;">
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
        <a href="{{ route('interface.dashboard_perawat') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Dashboard Perawat</div>
                    <div class="sidebar-header-sub">Panel Perawatan Klinik</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Menu Utama</div>
        <div class="sidebar-menu">
            <a href="{{ route('interface.dashboard_perawat') }}" class="sidebar-link active">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">Manajemen</div>
        <div class="sidebar-menu">
            <a href="{{ route('perawat.pasien.index') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i> <span>Data Pasien</span>
            </a>

            <a href="{{ route('perawat.pemeriksaan.index') }}" class="sidebar-link">
                <i class="bi bi-heart-pulse"></i> <span>Pemeriksaan</span>
            </a>

            <a href="{{ route('perawat.jadwal.index') }}" class="sidebar-link">
                <i class="bi bi-calendar-check"></i> <span>Jadwal Jaga</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">
        <div class="content">
            <div class="page-header">
                <h2>Dashboard Perawat</h2>
                <p>Kelola data pasien, hasil pemeriksaan, dan jadwal jaga dengan tampilan yang rapi dan konsisten.</p>
            </div>

            <!-- ⭐ 3 CARD DENGAN ICON ⭐ -->
            <div class="card-container">

                <a href="{{ route('perawat.pasien.index') }}" class="card-link">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3>Data Pasien</h3>
                        <p>Lihat dan pantau daftar pasien hewan beserta pemiliknya.</p>
                    </div>
                </a>

                <a href="{{ route('perawat.pemeriksaan.index') }}" class="card-link">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h3>Pemeriksaan</h3>
                        <p>Catat dan kelola hasil pemeriksaan hewan secara akurat dan cepat.</p>
                    </div>
                </a>

                <a href="{{ route('perawat.jadwal.index') }}" class="card-link">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <h3>Jadwal Jaga</h3>
                        <p>Lihat shift jaga Anda agar pelayanan tetap optimal.</p>
                        <div class="card-button">
                            Lihat Jadwal →
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div><!-- /main-area -->

</div><!-- /layout -->

</body>
</html>