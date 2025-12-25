<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT ELEGANT ORANGE SOFT (SAMA)
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

        /* ================= NAVBAR (TOP) – SAMA TEMA ================= */
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

        /* ---------- SIDEBAR (SETEMA DENGAN ADMIN) ---------- */
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
            background: rgba(255,255,255,0.78);
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
            margin-bottom: 18px;
        }

        .page-title-group {
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

        .page-badge {
            padding: 6px 14px;
            border-radius: 999px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
        }

        .page-badge i {
            font-size: 16px;
        }

        /* ================= WELCOME BANNER ================= */
        .welcome-banner {
            margin-top: 6px;
            background: linear-gradient(135deg, #102f76 0%, #142a46 65%, #f9a01b 100%);
            border-radius: 20px;
            padding: 22px 24px;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            box-shadow: 0 14px 32px rgba(0,0,0,0.30);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::after {
            content: "";
            position: absolute;
            right: -40px;
            top: -40px;
            width: 140px;
            height: 140px;
            border-radius: 40px;
            background: rgba(255,255,255,0.18);
        }

        .welcome-text-main {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        .welcome-highlight {
            color: #ffcf86;
        }

        .welcome-sub {
            margin-top: 8px;
            font-size: 13px;
            color: #f4f4f4;
            max-width: 420px;
        }

        .welcome-chips {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .welcome-chip {
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            font-size: 11px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .welcome-chip i {
            font-size: 13px;
            color: #ffcf86;
        }

        .welcome-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.25);
        }

        /* ================= GRID: LEFT CONTENT & RIGHT PROFILE ================= */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 22px;
            margin-top: 24px;
        }

        /* ================= STAT CARDS (CLICKABLE) ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 18px;
        }

        .stat-card {
            text-decoration: none;
            color: inherit;
            padding: 16px 18px;
            border-radius: 18px;
            background: radial-gradient(circle at top left, #f9a01b 0%, #b76b10 35%, #102f76 100%);
            background-size: 170% 170%;
            animation: cardGradient 7s ease infinite;
            box-shadow: 0 9px 20px rgba(0,0,0,0.18);
            position: relative;
            overflow: hidden;
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -40px;
            top: -40px;
            width: 90px;
            height: 90px;
            background: rgba(255,255,255,0.14);
            border-radius: 40px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: rgba(16,47,118,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            flex-shrink: 0;
        }

        .stat-text {
            position: relative;
            z-index: 1;
        }

        .stat-label {
            font-size: 13px;
            margin-bottom: 4px;
            color: #fffbe8;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
        }

        .stat-desc {
            font-size: 11px;
            margin-top: 2px;
            color: #fff5d6;
        }

        .stat-card:hover {
            filter: brightness(1.03);
            transform: translateY(-2px);
            box-shadow: 0 13px 26px rgba(0,0,0,0.24);
        }

        @keyframes cardGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ================= TIMELINE BOX ================= */
        .timeline-box {
            margin-top: 22px;
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 18px 14px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.12);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .timeline-title {
            font-size: 16px;
            font-weight: 700;
            color: #102f76;
        }

        .timeline-sub {
            font-size: 12px;
            color: #666;
        }

        .timeline-filter {
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(249,160,27,0.12);
            color: #102f76;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(249,160,27,0.5);
        }

        .timeline-filter i {
            color: #f9a01b;
        }

        .timeline-list {
            margin-top: 6px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 230px;
            overflow-y: auto;
        }

        .timeline-list::-webkit-scrollbar {
            width: 6px;
        }
        .timeline-list::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.15);
            border-radius: 999px;
        }

        .timeline-item {
            background: #fdfdfd;
            padding: 10px 12px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(0,0,0,0.04);
            transition: 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .timeline-item:hover {
            background: #fff7ef;
            border-color: rgba(249,160,27,0.45);
            transform: translateY(-1px);
        }

        .timeline-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #f9a01b;
            box-shadow: 0 0 0 4px rgba(249,160,27,0.25);
        }

        .timeline-texts {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .timeline-name {
            font-size: 13px;
            font-weight: 700;
            color: #102f76;
        }

        .timeline-time {
            font-size: 12px;
            color: #666;
        }

        .timeline-empty {
            font-size: 13px;
            color: #666;
            padding: 8px 2px 2px;
        }

        /* ================= RIGHT PROFILE PANEL ================= */
        .profile-panel {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 18px 16px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.12);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .profile-header-box {
            text-align: center;
        }

        .profile-avatar-big {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            margin: 0 auto 8px;
            background: linear-gradient(135deg, #102f76, #f9a01b);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 32px;
            font-weight: 800;
            box-shadow: 0 8px 22px rgba(0,0,0,0.25);
        }

        .profile-name-text {
            font-size: 17px;
            font-weight: 700;
            color: #102f76;
        }

        .profile-role-text {
            font-size: 12px;
            color: #666;
        }

        .profile-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            background: rgba(249,160,27,0.12);
            color: #102f76;
            font-size: 11px;
            margin-top: 6px;
        }

        .profile-status-badge i {
            color: #f9a01b;
        }

        .profile-stats {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 12px;
            color: #555;
        }

        .profile-stat-row {
            display: flex;
            justify-content: space-between;
        }

        .profile-stat-label {
            opacity: 0.8;
        }

        .profile-stat-value {
            font-weight: 600;
            color: #102f76;
        }

        .btn-profile {
            margin-top: 4px;
            padding: 8px 12px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
        }

        .btn-profile:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
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
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
            }
            .welcome-icon-circle {
                align-self: center;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .content {
                padding: 22px 18px 26px;
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
            <div class="brand-text-sub">Dashboard Pemilik</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari informasi atau menu...">
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
            <a href="{{ route('dashboard.pemilik') }}" class="sidebar-link active">
                <i class="bi bi-house-door-fill"></i> <span>Beranda</span>
            </a>
            <a href="{{ route('pemilik.hewan.index') }}" class="sidebar-link">
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
                    <div class="page-title">Dashboard Pemilik</div>
                    <div class="page-subtitle">
                        Ikuti perkembangan kesehatan hewan kesayangan Anda dalam satu tampilan.
                    </div>
                </div>
                <div class="page-badge">
                    <i class="bi bi-shield-heart"></i>
                    Panel Pemilik Hewan
                </div>
            </div>

            <!-- WELCOME BANNER (TETAP ADA SELAMAT DATANG) -->
            <div class="welcome-banner">
                <div>
                    <div class="welcome-text-main">
                        Selamat Datang, <span class="welcome-highlight">{{ $displayName }}</span>
                    </div>
                    <div class="welcome-sub">
                        Semoga hari Anda menyenangkan bersama hewan kesayangan Anda. Pantau jadwal kontrol,
                        riwayat kunjungan, dan rekam medis tanpa melewatkan satu pun detail 🐾
                    </div>

                    <div class="welcome-chips">
                        <div class="welcome-chip">
                            <i class="bi bi-heart-pulse-fill"></i>
                            Monitor kesehatan hewan
                        </div>
                        <div class="welcome-chip">
                            <i class="bi bi-calendar-check-fill"></i>
                            Atur temu dokter lebih mudah
                        </div>
                        <div class="welcome-chip">
                            <i class="bi bi-file-medical-fill"></i>
                            Rekam medis tersimpan rapi
                        </div>
                    </div>
                </div>
                <div class="welcome-icon-circle">
                    <i class="bi bi-paw-fill"></i>
                </div>
            </div>

            <!-- GRID: KIRI (STAT+TIMELINE) & KANAN (PROFILE) -->
            <div class="dashboard-grid">

                <!-- KIRI: STAT CARDS + TIMELINE -->
                <div>

                    <!-- STAT CARDS (4 FITUR, SEMUA BISA DIKLIK) -->
                    <div class="stats-grid">

                        <!-- TOTAL HEWAN -->
                        <a href="{{ route('pemilik.hewan.index') }}" class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div class="stat-text">
                                <div class="stat-label">Total Hewan</div>
                                <div class="stat-number">{{ $total_hewan }}</div>
                                <div class="stat-desc">Hewan yang terdaftar di akun Anda</div>
                            </div>
                        </a>

                        <!-- TOTAL KUNJUNGAN -->
                        <a href="{{ route('pemilik.kunjungan.index') }}" class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <div class="stat-text">
                                <div class="stat-label">Total Kunjungan</div>
                                <div class="stat-number">{{ $total_kunjungan }}</div>
                                <div class="stat-desc">Riwayat kunjungan ke klinik</div>
                            </div>
                        </a>

                        <!-- JADWAL TEMU DOKTER -->
                        <a href="{{ route('pemilik.temudokter.index') }}" class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-chat-dots-fill"></i>
                            </div>
                            <div class="stat-text">
                                <div class="stat-label">Jadwal Temu Dokter</div>
                                <div class="stat-number">{{ $total_temu_dokter }}</div>
                                <div class="stat-desc">Janji temu yang masih aktif</div>
                            </div>
                        </a>

                        <!-- REKAM MEDIS -->
                        <a href="{{ route('pemilik.rekammedis.index') }}" class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-file-medical-fill"></i>
                            </div>
                            <div class="stat-text">
                                <div class="stat-label">Rekam Medis</div>
                                <div class="stat-number">{{ $rekam_medis }}</div>
                                <div class="stat-desc">Rekam medis tersimpan di sistem</div>
                            </div>
                        </a>

                    </div>

                    <!-- TIMELINE JADWAL & RIWAYAT TERBARU -->
                    <div class="timeline-box">
                        <div class="timeline-header">
                            <div>
                                <div class="timeline-title">Jadwal & Riwayat Terbaru</div>
                                <div class="timeline-sub">
                                    Lihat janji temu mendatang dan kunjungan terakhir hewan Anda.
                                </div>
                            </div>
                            <div class="timeline-filter">
                                <i class="bi bi-clock-history"></i>
                                7 aktivitas terakhir
                            </div>
                        </div>

                        <div class="timeline-list">
                            @forelse ($jadwal as $item)
                                <a href="{{ route('pemilik.temudokter.detail', $item->idtemu_dokter) }}" class="timeline-item">
                                    <div class="timeline-left">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-texts">
                                            <div class="timeline-name">{{ $item->nama_hewan }}</div>
                                            <div class="timeline-time">{{ $item->tanggal }} • {{ $item->jam }}</div>
                                        </div>
                                    </div>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            @empty
                                <div class="timeline-empty">
                                    Belum ada jadwal atau riwayat terbaru. Ayo buat janji temu pertama untuk hewan kesayangan Anda 🐶
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- KANAN: PROFILE PANEL (CLICKABLE) -->
                <div>
                    <div class="profile-panel">
                        <div class="profile-header-box">
                            <div class="profile-avatar-big">{{ $initial }}</div>
                            <div class="profile-name-text">{{ $displayName }}</div>
                            <div class="profile-role-text">Pemilik Hewan</div>
                            <div class="profile-status-badge">
                                <i class="bi bi-patch-check-fill"></i>
                                Akun Aktif
                            </div>
                        </div>

                        <div class="profile-stats">
                            <div class="profile-stat-row">
                                <span class="profile-stat-label">Total Hewan</span>
                                <span class="profile-stat-value">{{ $total_hewan }}</span>
                            </div>
                            <div class="profile-stat-row">
                                <span class="profile-stat-label">Kunjungan</span>
                                <span class="profile-stat-value">{{ $total_kunjungan }}</span>
                            </div>
                            <div class="profile-stat-row">
                                <span class="profile-stat-label">Temu Dokter</span>
                                <span class="profile-stat-value">{{ $total_temu_dokter }}</span>
                            </div>
                            <div class="profile-stat-row">
                                <span class="profile-stat-label">Rekam Medis</span>
                                <span class="profile-stat-value">{{ $rekam_medis }}</span>
                            </div>
                        </div>

                        <!-- PROFILE HARUS BISA DIKLIK -->
                        <a href="{{ route('pemilik.profile') }}" class="btn-profile">
                            <i class="bi bi-person-lines-fill"></i>
                            Lihat Profil Lengkap
                        </a>
                    </div>
                </div>

            </div><!-- /dashboard-grid -->

        </div><!-- /content -->
    </div><!-- /main-area -->

</div><!-- /layout -->

</body>
</html>
