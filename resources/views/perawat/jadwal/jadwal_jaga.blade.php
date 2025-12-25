<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Jaga | Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT – SIGNATURE STYLE OCHA
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
            background: radial-gradient(circle at bottom, rgba(255,170,40,0.22), transparent 60%);
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
            opacity: 0.85;
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
            font-family: inherit;
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
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
        }

        .user-role {
            font-size: 11px;
            opacity: 0.85;
        }

        .btn-logout {
            padding: 7px 14px;
            border-radius: 999px;
            background: #f5594b;
            color: #fff;
            font-size: 12px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(245,89,75,0.5);
        }


                /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 215px;
            border-radius: 24px;
            background: linear-gradient(180deg, #102f76 0%, #142a46 100%);
            padding: 26px 22px 20px;
            color: #ffffff;
            box-shadow: 0 18px 38px rgba(0,0,0,0.35);
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

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 32px 36px 40px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn .45s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity:0; transform:translateY(15px); }
            to { opacity:1; transform:translateY(0); }
        }

        /* ================= HEADER ================= */
        .page-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .page-header-icon {
            font-size: 54px;
            color: #102f76;
            background: #f9a01b33;
            padding: 20px;
            border-radius: 50%;
            display: inline-block;
        }

        .page-header h1 {
            margin-top: 18px;
            font-size: 34px;
            font-weight: 800;
            color: #102f76;
        }

        .page-header p {
            font-size: 14px;
            color: #555;
            margin-top: 6px;
        }

        /* ================= BACK BUTTON ================= */
        .btn-back {
            padding: 10px 18px;
            background: #f9a01b;
            color: #102f76;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 26px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0,0,0,0.10);
        }

        th {
            background: linear-gradient(135deg, #102f76, #142a46);
            padding: 15px;
            font-size: 16px;
            color: #f9a01b;
            text-align: center;
        }

        td {
            padding: 14px;
            background: rgba(255,255,255,0.82);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-size: 15px;
            text-align: center;
        }

        tr:hover td {
            background: rgba(249,160,27,0.13);
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
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
            <input type="text" placeholder="Cari jadwal...">
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

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar">

        <a href="{{ route('interface.dashboard_perawat') }}" style="text-decoration:none; color:inherit;">
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

        <a href="{{ route('interface.dashboard_perawat') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-section-title">Manajemen</div>

        <a href="{{ route('perawat.pasien.index') }}" class="sidebar-link">
            <i class="bi bi-people-fill"></i> Data Pasien
        </a>

        <a href="{{ route('perawat.pemeriksaan.index') }}" class="sidebar-link">
            <i class="bi bi-clipboard2-pulse"></i> Pemeriksaan
        </a>

        <a href="{{ route('perawat.jadwal.index') }}" class="sidebar-link active">
            <i class="bi bi-calendar-check"></i> Jadwal Jaga
        </a>

        <div class="sidebar-bottom">
            © {{ date('Y') }} Klinik Hewan
        </div>

    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="content">

        <div class="page-header">
            <i class="bi bi-calendar-check page-header-icon"></i>
            <h1>Jadwal Jaga Perawat</h1>
            <p>Daftar shift dan jam jaga Anda di klinik.</p>
        </div>

        <a href="{{ route('perawat.dashboard') }}" class="btn-back">
            ← Kembali
        </a>

        @if ($jadwal->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($jadwal as $row)
                <tr>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->jam_mulai }}</td>
                    <td>{{ $row->jam_selesai }}</td>
                    <td>{{ $row->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @else
        <p style="text-align:center; margin-top:20px; font-size:15px; color:#666;">
            Belum ada jadwal jaga untuk Anda.
        </p>
        @endif

    </div>
</div>

</body>
</html>