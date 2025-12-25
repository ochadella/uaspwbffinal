<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pemilik</title>

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

        /* ================= GRID PROFIL & MEMBERSHIP ================= */
        .profile-grid {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 22px;
        }

        .card {
            background: #ffffff;
            border-radius: 18px;
            padding: 20px 22px 18px;
            box-shadow: 0 10px 24px rgba(0,0,0,0.10);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #102f76;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: #f9a01b;
            font-size: 18px;
        }

        .card-subtitle {
            font-size: 12px;
            color: #666;
        }

        /* ================= DATA DIRI ================= */
        .profile-identity {
            display: flex;
            gap: 18px;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            padding-bottom: 16px;
        }

        .profile-avatar-big {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #102f76, #f9a01b);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 34px;
            font-weight: 800;
            box-shadow: 0 8px 22px rgba(0,0,0,0.25);
        }

        .profile-identity-texts {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 800;
            color: #102f76;
        }

        .profile-role {
            font-size: 12px;
            color: #666;
        }

        .profile-id {
            font-size: 11px;
            color: #888;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        .info-row {
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 140px;
            padding: 7px 0;
            font-size: 13px;
            color: #666;
            font-weight: 600;
        }

        .info-value {
            padding: 7px 0;
            font-size: 13px;
            color: #222;
        }

        /* ================= MEMBERSHIP ================= */
        .membership-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .membership-status-badge i {
            font-size: 14px;
        }

        .membership-verified {
            background: rgba(46,204,113,0.16);
            color: #1e8d50;
            border: 1px solid rgba(46,204,113,0.6);
        }

        .membership-notyet {
            background: rgba(249,160,27,0.15);
            color: #b06a10;
            border: 1px solid rgba(249,160,27,0.6);
        }

        .membership-metrics {
            margin-top: 12px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 10px;
        }

        .metric-box {
            background: #faf8ff;
            border-radius: 12px;
            padding: 10px 12px;
            border: 1px solid rgba(16,47,118,0.05);
        }

        .metric-label {
            font-size: 12px;
            color: #666;
        }

        .metric-value {
            margin-top: 4px;
            font-size: 18px;
            font-weight: 800;
            color: #102f76;
        }

        .metric-note {
            margin-top: 2px;
            font-size: 11px;
            color: #777;
        }

        .progress-wrapper {
            margin-top: 14px;
        }

        .progress-label-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #666;
            margin-bottom: 4px;
        }

        .progress-bar-bg {
            width: 100%;
            height: 10px;
            border-radius: 999px;
            background: #f1f1f1;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
        }

        .membership-note {
            margin-top: 10px;
            font-size: 12px;
            color: #555;
        }

        .membership-note strong {
            color: #102f76;
        }

        /* ================= RINGKASAN SINGKAT DI BAWAH ================= */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 16px;
            margin-top: 22px;
        }

        .summary-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 12px 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-icon {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            background: rgba(16,47,118,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #102f76;
            font-size: 18px;
        }

        .summary-texts {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .summary-label {
            font-size: 11px;
            color: #666;
        }

        .summary-value {
            font-size: 15px;
            font-weight: 700;
            color: #102f76;
        }

        .summary-link {
            font-size: 11px;
            color: #f9a01b;
            text-decoration: none;
        }

        .summary-link:hover {
            text-decoration: underline;
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
            .profile-grid {
                grid-template-columns: 1fr;
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
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $pemilik->nama ?? $user->nama ?? $user->name ?? 'Pemilik';
    $displayRole = 'Pemilik Hewan';
    $initial = strtoupper(mb_substr($displayName, 0, 1));

    $totalPet = $jumlahPet ?? 0;
    $totalKunjungan = $jumlahKunjungan ?? 0;

    $isMember = $totalKunjungan >= 10;
    $sisa = max(0, 10 - $totalKunjungan);
    $progress = min(100, ($totalKunjungan / 10) * 100);
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Profil Pemilik</div>
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
            <a href="{{ route('pemilik.profile') }}" class="sidebar-link active">
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
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="page-title-texts">
                        <div class="page-title">Profil Pemilik</div>
                        <div class="page-subtitle">
                            Data diri pemilik dan status membership di Klinik Hewan.
                        </div>
                    </div>
                </div>
                <div class="page-badge">
                    <i class="bi bi-shield-heart"></i>
                    Akun Pemilik Hewan
                </div>
            </div>

            <!-- GRID PROFIL + MEMBERSHIP -->
            <div class="profile-grid">

                <!-- KIRI: DATA DIRI -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">
                                <i class="bi bi-person-lines-fill"></i>
                                Data Diri Pemilik
                            </div>
                            <div class="card-subtitle">
                                Informasi diambil dari registrasi pemilik pada resepsionis.
                            </div>
                        </div>
                    </div>

                    <div class="profile-identity">
                        <div class="profile-avatar-big">{{ $initial }}</div>
                        <div class="profile-identity-texts">
                            <div class="profile-name">{{ $pemilik->nama ?? '-' }}</div>
                            <div class="profile-role">Pemilik Hewan Terdaftar</div>
                            <div class="profile-id">
                                ID Pemilik: {{ $pemilik->idpemilik ?? '-' }} • ID User: {{ $pemilik->iduser ?? ($user->iduser ?? '-') }}
                            </div>
                        </div>
                    </div>

                    <table class="info-table">
                        <tr class="info-row">
                            <td class="info-label">Nama Lengkap</td>
                            <td class="info-value">{{ $pemilik->nama ?? '-' }}</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-label">Email</td>
                            <td class="info-value">{{ $pemilik->email ?? ($user->email ?? '-') }}</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-label">No. WhatsApp</td>
                            <td class="info-value">{{ $pemilik->no_wa ?? '-' }}</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-label">Alamat</td>
                            <td class="info-value">{{ $pemilik->alamat ?? '-' }}</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-label">Total Hewan</td>
                            <td class="info-value">{{ $totalPet }} hewan terdaftar</td>
                        </tr>
                        <tr class="info-row">
                            <td class="info-label">Total Kunjungan</td>
                            <td class="info-value">{{ $totalKunjungan }} kali berkunjung</td>
                        </tr>
                    </table>
                </div>

                <!-- KANAN: STATUS MEMBERSHIP -->
                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">
                                <i class="bi bi-stars"></i>
                                Status Membership
                            </div>
                            <div class="card-subtitle">
                                Membership dihitung dari total kunjungan ke klinik.
                            </div>
                        </div>
                        <div>
                            @if($isMember)
                                <span class="membership-status-badge membership-verified">
                                    <i class="bi bi-patch-check-fill"></i>
                                    Member Terverifikasi
                                </span>
                            @else
                                <span class="membership-status-badge membership-notyet">
                                    <i class="bi bi-hourglass-split"></i>
                                    Belum Member
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="membership-metrics">
                        <div class="metric-box">
                            <div class="metric-label">Total Kunjungan</div>
                            <div class="metric-value">{{ $totalKunjungan }}</div>
                            <div class="metric-note">Minimal 10 kunjungan untuk menjadi member.</div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Total Hewan Terdaftar</div>
                            <div class="metric-value">{{ $totalPet }}</div>
                            <div class="metric-note">Semua hewan yang tercatat di sistem.</div>
                        </div>
                    </div>

                    <div class="progress-wrapper">
                        <div class="progress-label-row">
                            <span>Progress Menuju Membership</span>
                            <span>{{ $totalKunjungan }}/10 kunjungan</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width: {{ $progress }}%;"></div>
                        </div>
                    </div>

                    <div class="membership-note">
                        @if($isMember)
                            🎉 <strong>Selamat!</strong> Anda telah mencapai lebih dari 10 kali kunjungan dan
                            berstatus <strong>Member Terverifikasi</strong> di Klinik Hewan. Terima kasih sudah
                            rutin mempercayakan perawatan hewan kesayangan Anda kepada kami 🐾
                        @else
                            Anda telah berkunjung sebanyak <strong>{{ $totalKunjungan }}</strong> kali.
                            Tinggal <strong>{{ $sisa }}</strong> kunjungan lagi untuk menjadi
                            <strong>Member Terverifikasi</strong> dan mendapatkan berbagai keuntungan khusus pemilik hewan tetap.
                        @endif
                    </div>
                </div>

            </div><!-- /profile-grid -->

            <!-- RINGKASAN CEPAT LINK KE FITUR LAIN -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div class="summary-texts">
                        <div class="summary-label">Hewan Terdaftar</div>
                        <div class="summary-value">{{ $totalPet }} Hewan</div>
                        <a href="{{ route('pemilik.hewan.index') }}" class="summary-link">
                            Lihat daftar hewan
                        </a>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="bi bi-journal-medical"></i>
                    </div>
                    <div class="summary-texts">
                        <div class="summary-label">Riwayat Kunjungan</div>
                        <div class="summary-value">{{ $totalKunjungan }} Kunjungan</div>
                        <a href="{{ route('pemilik.kunjungan.index') }}" class="summary-link">
                            Lihat riwayat lengkap
                        </a>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="bi bi-file-medical"></i>
                    </div>
                    <div class="summary-texts">
                        <div class="summary-label">Rekam Medis</div>
                        <div class="summary-value">Lihat Detail</div>
                        <a href="{{ route('pemilik.rekammedis.index') }}" class="summary-link">
                            Buka rekam medis
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main-area -->

</div><!-- /layout -->

</body>
</html>
