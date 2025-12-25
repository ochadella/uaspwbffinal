<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Resepsionis</title>

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
            overflow-y: auto;
        }

        /* ================= PROFILE CONTENT ================= */
        .profile-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .profile-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            animation: fadeIn 0.5s ease;
            margin-bottom: 22px;
        }

        .profile-card.full-width {
            grid-column: 1 / -1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 30px;
            padding-bottom: 24px;
            border-bottom: 2px solid rgba(16,47,118,0.15);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #102f76, #f9a01b);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 42px;
            font-weight: 800;
            box-shadow: 0 8px 20px rgba(16,47,118,0.3);
            flex-shrink: 0;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(16,47,118,0.4);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-avatar:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-overlay i {
            color: #fff;
            font-size: 28px;
        }

        .photo-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-photo {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-upload {
            background: #f9a01b;
            color: #102f76;
        }

        .btn-upload:hover {
            background: #ffba4c;
        }

        .btn-delete {
            background: #f5594b;
            color: #fff;
        }

        .btn-delete:hover {
            background: #e04437;
        }

        .modal-upload {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-upload.show {
            display: flex;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .modal-content h3 {
            margin: 0 0 20px;
            color: #102f76;
            font-size: 20px;
        }

        .upload-area {
            border: 2px dashed #102f76;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            background: rgba(16,47,118,0.05);
            border-color: #f9a01b;
        }

        .upload-area i {
            font-size: 48px;
            color: #f9a01b;
            margin-bottom: 10px;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-modal {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel {
            background: #e0e0e0;
            color: #555;
        }

        .btn-cancel:hover {
            background: #d0d0d0;
        }

        .btn-save {
            background: #102f76;
            color: #fff;
        }

        .btn-save:hover {
            background: #0b255a;
        }

        .profile-info h2 {
            margin: 0 0 5px;
            color: #102f76;
            font-size: 26px;
            font-weight: 800;
        }

        .profile-info .subtitle {
            color: #666;
            font-size: 14px;
            margin: 0;
        }

        .profile-info .badge {
            display: inline-block;
            margin-top: 8px;
            padding: 5px 12px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #102f76;
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 18px;
        }

        .section-title i {
            font-size: 22px;
            color: #f9a01b;
        }

        .info-row {
            display: flex;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(0,0,0,0.08);
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            flex: 0 0 140px;
            font-weight: 600;
            color: #555;
            font-size: 13px;
        }

        .info-value {
            flex: 1;
            color: #222;
            font-size: 13px;
        }

        .info-value.highlight {
            color: #102f76;
            font-weight: 600;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .tag {
            padding: 6px 14px;
            background: rgba(16,47,118,0.08);
            border: 1px solid rgba(16,47,118,0.15);
            border-radius: 999px;
            font-size: 12px;
            color: #102f76;
            font-weight: 600;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            left: 8px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: linear-gradient(180deg, #102f76, #f9a01b);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -25px;
            top: 4px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #f9a01b;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #f9a01b;
        }

        .timeline-title {
            font-weight: 700;
            color: #102f76;
            margin: 0 0 4px;
            font-size: 14px;
        }

        .timeline-meta {
            font-size: 12px;
            color: #666;
            margin: 0 0 6px;
        }

        .timeline-desc {
            font-size: 13px;
            color: #444;
            line-height: 1.5;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            background: #102f76;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(16,47,118,0.3);
            transition: all 0.2s ease;
            margin-top: 20px;
        }

        .btn-back:hover {
            background: #0b255a;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16,47,118,0.4);
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
            .profile-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'Resepsionis';
    $displayRole = ucfirst($user->role ?? 'Resepsionis');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Resepsionis</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari menu atau data...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ route('resepsionis.profile') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
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
        <a href="{{ route('dashboard.resepsionis') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Dashboard Resepsionis</div>
                    <div class="sidebar-header-sub">Panel Pelayanan Klinik</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Menu Utama</div>
        <div class="sidebar-menu">
            <a href="{{ route('dashboard.resepsionis') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">Registrasi</div>
        <div class="sidebar-menu">
            <a href="{{ route('resepsionis.pemilik.regris') }}" class="sidebar-link">
                <i class="bi bi-person-vcard"></i> <span>Registrasi Pemilik</span>
            </a>

            <a href="{{ route('resepsionis.pet.regris') }}" class="sidebar-link">
                <i class="bi bi-plus-circle"></i> <span>Registrasi Pet</span>
            </a>

            <a href="{{ route('resepsionis.temudokter') }}" class="sidebar-link">
                <i class="bi bi-calendar-check"></i> <span>Temu Dokter</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">

        <!-- PROFILE HEADER CARD -->
        <div class="profile-card full-width">
            <div class="profile-header">
                <div>
                    <div class="profile-avatar" onclick="openUploadModal()">
                        @if(isset($user->foto_profile) && $user->foto_profile)
                            <img src="{{ asset('storage/profil/' . $user->foto_profile) }}" alt="Foto Profile">
                        @else
                            {{ $initial }}
                        @endif
                        <div class="avatar-overlay">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                    </div>
                    <div class="photo-actions">
                        <button class="btn-photo btn-upload" onclick="openUploadModal()">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                        @if(isset($user->foto_profile) && $user->foto_profile)
                            <button class="btn-photo btn-delete" onclick="deletePhoto()">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        @endif
                    </div>
                </div>
                <div class="profile-info">
                    <h2>{{ $user->nama ?? $displayName }}</h2>
                    <p class="subtitle">Resepsionis Klinik • {{ $user->email ?? 'email@klinik.com' }}</p>
                    <span class="badge"><i class="bi bi-shield-check"></i> Karyawan Aktif</span>
                </div>
            </div>

            <div class="section-title">
                <i class="bi bi-person-badge"></i>
                Informasi Dasar
            </div>

            <div class="info-row">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value highlight">{{ $user->nama ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $user->email ?? '-' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Role</div>
                <div class="info-value highlight">{{ ucfirst($user->role ?? 'Resepsionis') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">No. Telepon</div>
                <div class="info-value">{{ $user->nohp ?? '+62 821-xxxx-xxxx' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat Domisili</div>
                <div class="info-value">{{ $user->alamat ?? 'Surabaya, Jawa Timur' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Lahir</div>
                <div class="info-value">{{ $user->tanggal_lahir ?? '20 Mei 1995' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Kelamin</div>
                <div class="info-value">{{ $user->jenis_kelamin ?? 'Perempuan' }}</div>
            </div>
        </div>

        <div class="profile-container">

            <!-- INFORMASI KEPEGAWAIAN -->
            <div class="profile-card">
                <div class="section-title">
                    <i class="bi bi-briefcase"></i>
                    Informasi Kepegawaian
                </div>

                <div class="info-row">
                    <div class="info-label">ID Karyawan</div>
                    <div class="info-value highlight">{{ $user->id_karyawan ?? 'RCP-2024-001' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Bergabung</div>
                    <div class="info-value">{{ $user->tanggal_bergabung ?? '1 Januari 2024' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status Kepegawaian</div>
                    <div class="info-value highlight">{{ $user->status_kepegawaian ?? 'Tetap' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Shift</div>
                    <div class="info-value">{{ $user->shift ?? 'Pagi (08:00 - 16:00)' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Atasan Langsung</div>
                    <div class="info-value">{{ $user->atasan ?? 'Manager Operasional' }}</div>
                </div>
            </div>

            <!-- KOMPETENSI & SKILL -->
            <div class="profile-card">
                <div class="section-title">
                    <i class="bi bi-star"></i>
                    Kompetensi & Skill
                </div>

                <div class="tag-container">
                    <div class="tag">Customer Service</div>
                    <div class="tag">Registrasi Pasien</div>
                    <div class="tag">Manajemen Jadwal</div>
                    <div class="tag">Administrasi</div>
                    <div class="tag">Kasir</div>
                    <div class="tag">Komunikasi</div>
                    <div class="tag">MS Office</div>
                    <div class="tag">Data Entry</div>
                </div>
            </div>

        </div>

        <!-- RIWAYAT PENDIDIKAN -->
        <div class="profile-card full-width">
            <div class="section-title">
                <i class="bi bi-mortarboard"></i>
                Riwayat Pendidikan
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <h4 class="timeline-title">Diploma III - Administrasi Perkantoran</h4>
                    <p class="timeline-meta">Politeknik Negeri Surabaya • 2013 - 2016</p>
                    <p class="timeline-desc">Fokus pada manajemen administrasi dan pelayanan pelanggan</p>
                </div>

                <div class="timeline-item">
                    <h4 class="timeline-title">Pelatihan Customer Service Excellence</h4>
                    <p class="timeline-meta">Lembaga Pelatihan Profesional • 2022</p>
                    <p class="timeline-desc">Sertifikasi pelayanan prima dan komunikasi efektif</p>
                </div>

                <div class="timeline-item">
                    <h4 class="timeline-title">Workshop Sistem Informasi Klinik</h4>
                    <p class="timeline-meta">Asosiasi Klinik Indonesia • 2023</p>
                    <p class="timeline-desc">Pelatihan penggunaan sistem informasi manajemen klinik modern</p>
                </div>
            </div>
        </div>

        <!-- PENGALAMAN KERJA -->
        <div class="profile-card full-width">
            <div class="section-title">
                <i class="bi bi-clock-history"></i>
                Pengalaman Kerja
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <h4 class="timeline-title">Resepsionis - Klinik Hewan Sehat</h4>
                    <p class="timeline-meta">2024 - Sekarang</p>
                    <p class="timeline-desc">Menangani registrasi pasien, manajemen jadwal, pembayaran, dan pelayanan customer service</p>
                </div>

                <div class="timeline-item">
                    <h4 class="timeline-title">Front Office - RS Veteriner Prima</h4>
                    <p class="timeline-meta">2020 - 2024</p>
                    <p class="timeline-desc">Bertanggung jawab atas penerimaan pasien, koordinasi jadwal dokter, dan administrasi klinik</p>
                </div>

                <div class="timeline-item">
                    <h4 class="timeline-title">Admin - Pet Shop & Grooming</h4>
                    <p class="timeline-meta">2017 - 2020</p>
                    <p class="timeline-desc">Mengelola administrasi toko, kasir, dan layanan pelanggan untuk pet shop</p>
                </div>
            </div>
        </div>

        <!-- TUGAS & TANGGUNG JAWAB -->
        <div class="profile-container">
            <div class="profile-card">
                <div class="section-title">
                    <i class="bi bi-list-check"></i>
                    Tugas Utama
                </div>

                <div class="tag-container">
                    <div class="tag">Pendaftaran Pasien Baru</div>
                    <div class="tag">Update Data Pasien</div>
                    <div class="tag">Koordinasi Jadwal</div>
                    <div class="tag">Konfirmasi Appointment</div>
                    <div class="tag">Penerimaan Pembayaran</div>
                    <div class="tag">Pembuatan Invoice</div>
                    <div class="tag">Arsip Dokumen</div>
                    <div class="tag">Layanan Informasi</div>
                </div>
            </div>

            <div class="profile-card">
                <div class="section-title">
                    <i class="bi bi-telephone"></i>
                    Kontak Darurat
                </div>

                <div class="info-row">
                    <div class="info-label">Nama Kontak</div>
                    <div class="info-value">{{ $user->kontak_darurat_nama ?? 'Ibu Siti Aminah' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Hubungan</div>
                    <div class="info-value">{{ $user->kontak_darurat_relasi ?? 'Ibu Kandung' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-value highlight">{{ $user->kontak_darurat_nohp ?? '+62 812-xxxx-xxxx' }}</div>
                </div>
            </div>
        </div>

        <!-- BUTTON KEMBALI -->
        <div class="profile-card full-width">
            <a href="{{ route('dashboard.resepsionis') }}" class="btn-back">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali ke Dashboard
            </a>
        </div>

    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- MODAL UPLOAD FOTO -->
<div id="modalUpload" class="modal-upload">
    <div class="modal-content">
        <h3><i class="bi bi-camera-fill"></i> Upload Foto Profil</h3>
        
        <form id="formUploadPhoto" enctype="multipart/form-data">
            @csrf
            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <i class="bi bi-cloud-upload"></i>
                <p style="margin: 10px 0 5px; color: #102f76; font-weight: 600;">Klik untuk pilih foto</p>
                <p style="margin: 0; font-size: 12px; color: #666;">Format: JPG, PNG (Max 2MB)</p>
                <input type="file" id="fileInput" name="foto_profile" accept="image/*" style="display: none;" onchange="previewImage(this)">
            </div>
            
            <div id="imagePreview" style="margin-top: 15px; text-align: center; display: none;">
                <img id="preview" style="max-width: 100%; max-height: 200px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                <p id="fileName" style="margin-top: 8px; font-size: 13px; color: #666;"></p>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-modal btn-cancel" onclick="closeUploadModal()">Batal</button>
                <button type="submit" class="btn-modal btn-save">Simpan Foto</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open Upload Modal
    function openUploadModal() {
        document.getElementById('modalUpload').classList.add('show');
    }

    // Close Upload Modal
    function closeUploadModal() {
        document.getElementById('modalUpload').classList.remove('show');
        document.getElementById('formUploadPhoto').reset();
        document.getElementById('imagePreview').style.display = 'none';
    }

    // Preview Image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('fileName').textContent = input.files[0].name;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Upload Photo
    document.getElementById('formUploadPhoto').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('{{ route("resepsionis.profile.upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto profil berhasil diupload!');
                location.reload();
            } else {
                alert('Gagal upload foto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat upload foto');
        });
    });

    // Delete Photo
    function deletePhoto() {
        if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
            fetch('{{ route("resepsionis.profile.delete-photo") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Foto profil berhasil dihapus!');
                    location.reload();
                } else {
                    alert('Gagal menghapus foto');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modalUpload');
        if (event.target === modal) {
            closeUploadModal();
        }
    }
</script>

</body>
</html>