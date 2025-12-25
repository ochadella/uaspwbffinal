<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Temu Dokter</title>

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

        /* ================= CENTERED PAGE HEADER ================= */
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-header-icon {
            font-size: 54px;
            color: #102f76;
            background: #f9a01b33;
            padding: 20px;
            border-radius: 50%;
        }

        .page-header h1 {
            margin-top: 18px;
            font-size: 34px;
            color: #102f76;
            font-weight: 800;
        }

        .page-header p {
            margin-top: -6px;
            font-size: 15px;
            color: #3c3c3c;
        }

        /* ================= CONTAINER CARD ================= */
        .container-card {
            margin: 0 auto;
            max-width: 100%;
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

        /* ================= ALERT ================= */
        .alert-box {
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #e7f7e9;
            border: 1px solid #52b46b;
            color: #256b3a;
        }

        .alert-error {
            background: #fde8e8;
            border: 1px solid #f08c8c;
            color: #8b1d1d;
        }

        /* ================= BUTTONS ================= */
        .btn-add {
            padding: 12px 20px;
            background: linear-gradient(90deg, #f9a01b, #ffba4c);
            color: #102f76;
            text-decoration: none;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
        }

        .btn-back {
            margin-left: 10px;
            padding: 10px 18px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        /* ================= TABLE ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 28px;
            overflow: hidden;
            border-radius: 14px;
            box-shadow: 0 10px 26px rgba(0,0,0,0.10);
        }

        th {
            background: linear-gradient(135deg, #102f76 0%, #142a46 100%);
            color: #f9a01b;
            padding: 15px;
            font-size: 16px;
            text-align: center;
        }

        td {
            padding: 14px;
            background: rgba(255,255,255,0.82);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            text-align: center;
            vertical-align: middle;
        }

        tr:hover td {
            background: rgba(249,160,27,0.13);
        }

        /* ================= STATUS BADGE ================= */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .status-antrian {
            background: #e2e3ff;
            color: #383d7c;
            border: 1px solid #c6c8ff;
        }

        .status-diperiksa {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-batal {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ================= ACTION ICONS ================= */
        .action-icons {
            display: flex;
            justify-content: center;
            gap: 16px;
            align-items: center;
        }

        .icon-btn {
            font-size: 22px;
            color: #102f76;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .icon-btn:hover {
            color: #f9a01b;
            transform: translateY(-2px);
        }

        .icon-btn.delete:hover {
            color: #ff4d4d;
        }

        /* ================= MODAL ================= */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal.show {
            display: flex;
        }

        .modal-box {
            width: 460px;
            max-width: 95%;
            background: #ffffff;
            padding: 26px 26px 22px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.28);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .modal-box h2 {
            text-align: center;
            margin: 0 0 10px;
            color: #102f76;
            font-size: 20px;
            font-weight: 800;
        }

        .modal-box label {
            display: block;
            margin-top: 10px;
            margin-bottom: 4px;
            font-size: 13px;
            font-weight: 600;
            color: #102f76;
        }

        .modal-box input,
        .modal-box select,
        .modal-box textarea {
            width: 100%;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid #d0d0d0;
            font-size: 13px;
            box-sizing: border-box;
        }

        .modal-box textarea {
            resize: vertical;
            min-height: 70px;
        }

        .modal-buttons {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            padding: 9px 16px;
            border-radius: 8px;
            border: none;
            background: #6c757d;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-submit {
            padding: 9px 18px;
            border-radius: 8px;
            border: none;
            background: #f9a01b;
            color: #102f76;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-submit:hover {
            background: #ffba4c;
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
    </style>
</head>

<body>

@php
    $user        = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Resepsionis');
    $initial     = strtoupper(mb_substr($displayName, 0, 1));
@endphp

@php
    $dokter = $dokter ?? [];   // ⬅️ WAJIB ADA
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
            <input type="text" placeholder="Cari antrian temu dokter...">
        </div>
    </div>

    <div class="nav-right">
        <!-- ⭐⭐⭐ BAGIAN INI YANG DIUBAH - DITAMBAHKAN LINK KE PROFILE ⭐⭐⭐ -->
        <a href="{{ route('resepsionis.profile') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; transition: opacity 0.2s;">
            <div class="user-info">
                <div class="user-avatar">{{ $initial }}</div>
                <div>
                    <div class="user-name">{{ $displayName }}</div>
                    <div class="user-role">{{ $displayRole }}</div>
                </div>
            </div>
        </a>
        <!-- ⭐⭐⭐ AKHIR PERUBAHAN ⭐⭐⭐ -->
        <a href="{{ route('logout') }}" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<div class="layout">

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
                <i class="bi bi-bag-heart"></i> <span>Registrasi Pet</span>
            </a>
            <a href="{{ route('resepsionis.temudokter') }}" class="sidebar-link active">
                <i class="bi bi-calendar-check"></i> <span>Temu Dokter</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">

        <!-- HEADER TENGAH -->
        <div class="page-header">
            <i class="bi bi-calendar-check page-header-icon"></i>
            <h1>Temu Dokter</h1>
            <p>Kelola antrian temu dokter untuk hewan peliharaan.</p>
        </div>

        <!-- CONTENT CARD -->
        <div class="container-card">

            {{-- ALERT FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert-box alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- BUTTON TAMBAH TEMU DOKTER -->
            <button type="button" class="btn-add" onclick="openAddModal()">+ Tambah Temu Dokter</button>
            <a href="{{ route('dashboard.resepsionis') }}" class="btn-back">← Kembali</a>

            <!-- TABEL DATA TEMU DOKTER -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Temu</th>
                        <th>Waktu Temu</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th>Nama Hewan</th>
                        <th>Pemilik</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rows as $row)
                        @php
                            $statusText  = $row->status ?? 'Menunggu';
                            $statusClass = 'status-badge status-menunggu';

                            if ($statusText === 'Menunggu') {
                                $statusClass = 'status-badge status-menunggu';
                            } elseif ($statusText === 'Dalam Antrian') {
                                $statusClass = 'status-badge status-antrian';
                            } elseif ($statusText === 'Sedang Diperiksa') {
                                $statusClass = 'status-badge status-diperiksa';
                            } elseif ($statusText === 'Selesai') {
                                $statusClass = 'status-badge status-selesai';
                            } elseif ($statusText === 'Batal') {
                                $statusClass = 'status-badge status-batal';
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tanggal_temu ?? '-' }}</td>
                            <td>{{ $row->waktu_temu ?? '-' }}</td>
                            <td>{{ $row->nama_dokter ?? '-' }}</td>
                            <td>
                                <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>{{ $row->nama_pet ?? '-' }}</td>
                            <td>{{ $row->nama_pemilik ?? '-' }}</td>
                            <td>{{ $row->keluhan ?? '-' }}</td>
                            <td>
                                <div class="action-icons">
                                    <!-- EDIT -->
                                    <a href="javascript:void(0)"
                                       class="icon-btn"
                                       title="Edit Temu Dokter"
                                       onclick="openEditModal(this)"
                                       data-id="{{ $row->idtemu_dokter }}"
                                       data-tanggal_temu="{{ $row->tanggal_temu }}"
                                       data-waktu_temu="{{ $row->waktu_temu }}"
                                       data-status="{{ $row->status }}"
                                       data-idpet="{{ $row->idpet }}"
                                       data-idpemilik="{{ $row->idpemilik }}"
                                       data-dokter_id="{{ $row->dokter_id ?? '' }}"
                                       data-keluhan="{{ $row->keluhan }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <a href="javascript:void(0)"
                                       class="icon-btn delete"
                                       title="Hapus Temu Dokter"
                                       onclick="deleteTemuDokter('{{ $row->idtemu_dokter }}')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="color:#666;">Belum ada data temu dokter</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div><!-- /container-card -->
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- ==================== MODAL TAMBAH TEMU DOKTER ==================== -->
<div id="modalAddTemu" class="modal">
    <div class="modal-box">
        <h2>Tambah Temu Dokter</h2>

        <form id="formAddTemu" method="POST" action="{{ route('resepsionis.temudokter.store') }}">
            @csrf

            <label for="add_idpet">Hewan *</label>
            <select id="add_idpet"
                    name="idpet"
                    required>
                <option value="">-- Pilih Hewan --</option>
                @foreach($pets as $p)
                    <option value="{{ $p->idpet }}">{{ $p->nama_pet ?? $p->nama ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="add_idpemilik">Pemilik *</label>
            <select id="add_idpemilik"
                    name="idpemilik"
                    required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilik as $pm)
                    <option value="{{ $pm->idpemilik }}">{{ $pm->nama_pemilik ?? $pm->nama ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="add_dokter_id">Dokter Pemeriksa *</label>
            <select id="add_dokter_id"
                    name="dokter_id"
                    required>
                <option value="">-- Pilih Dokter --</option>
                @foreach(($dokter ?? []) as $dr)
                    <option value="{{ $dr->id }}">{{ $dr->nama ?? $dr->name ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="add_tanggal_temu">Tanggal Temu *</label>
            <input type="date"
                   id="add_tanggal_temu"
                   name="tanggal_temu"
                   required>

            <label for="add_waktu_temu">Waktu Temu</label>
            <input type="time"
                   id="add_waktu_temu"
                   name="waktu_temu">

            <label for="add_keluhan">Keluhan</label>
            <textarea id="add_keluhan"
                      name="keluhan"
                      placeholder="Keluhan / alasan temu dokter"></textarea>

            <label for="add_status">Status *</label>
            <select id="add_status"
                    name="status"
                    required>
                <option value="Menunggu">Menunggu</option>
                <option value="Dalam Antrian">Dalam Antrian</option>
                <option value="Sedang Diperiksa">Sedang Diperiksa</option>
                <option value="Selesai">Selesai</option>
                <option value="Batal">Batal</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT TEMU DOKTER ==================== -->
<div id="modalEditTemu" class="modal">
    <div class="modal-box">
        <h2>Edit Temu Dokter</h2>

        <form id="formEditTemu" method="POST" action="">
            @csrf

            <label for="edit_idpet">Hewan *</label>
            <select id="edit_idpet"
                    name="idpet"
                    required>
                <option value="">-- Pilih Hewan --</option>
                @foreach($pets as $p)
                    <option value="{{ $p->idpet }}">{{ $p->nama_pet ?? $p->nama ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="edit_idpemilik">Pemilik *</label>
            <select id="edit_idpemilik"
                    name="idpemilik"
                    required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilik as $pm)
                    <option value="{{ $pm->idpemilik }}">{{ $pm->nama_pemilik ?? $pm->nama ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="edit_dokter_id">Dokter Pemeriksa *</label>
            <select id="edit_dokter_id"
                    name="dokter_id"
                    required>
                <option value="">-- Pilih Dokter --</option>
                @foreach(($dokter ?? []) as $dr)
                    <option value="{{ $dr->id }}">{{ $dr->nama ?? $dr->name ?? 'Tanpa Nama' }}</option>
                @endforeach
            </select>

            <label for="edit_tanggal_temu">Tanggal Temu *</label>
            <input type="date"
                   id="edit_tanggal_temu"
                   name="tanggal_temu"
                   required>

            <label for="edit_waktu_temu">Waktu Temu</label>
            <input type="time"
                   id="edit_waktu_temu"
                   name="waktu_temu">

            <label for="edit_keluhan">Keluhan</label>
            <textarea id="edit_keluhan"
                      name="keluhan"
                      placeholder="Keluhan / alasan temu dokter"></textarea>

            <label for="edit_status">Status *</label>
            <select id="edit_status"
                    name="status"
                    required>
                <option value="Menunggu">Menunggu</option>
                <option value="Dalam Antrian">Dalam Antrian</option>
                <option value="Sedang Diperiksa">Sedang Diperiksa</option>
                <option value="Selesai">Selesai</option>
                <option value="Batal">Batal</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ================= MODAL TAMBAH =================
    function openAddModal() {
    const form = document.getElementById('formAddTemu');
    form.reset();

    // WAJIB! Kosongkan dropdown dokter sebelum AJAX mengisi ulang
    document.getElementById('add_dokter_id').innerHTML =
        '<option value="">-- Pilih Dokter --</option>';

    // Kosongkan jam juga
    document.getElementById('add_waktu_temu').value = '';

    document.getElementById('modalAddTemu').classList.add('show');
}

    function closeAddModal() {
        document.getElementById('modalAddTemu').classList.remove('show');
    }


    // ================= MODAL EDIT =================
    function openEditModal(el) {
        const id           = el.getAttribute('data-id');
        const tanggalTemu  = el.getAttribute('data-tanggal_temu');
        const waktuTemu    = el.getAttribute('data-waktu_temu');
        const status       = el.getAttribute('data-status');
        const idpet        = el.getAttribute('data-idpet');
        const idpemilik    = el.getAttribute('data-idpemilik');
        const dokterId     = el.getAttribute('data-dokter_id');
        const keluhan      = el.getAttribute('data-keluhan');

        document.getElementById('edit_tanggal_temu').value = tanggalTemu || '';
        document.getElementById('edit_waktu_temu').value   = waktuTemu || '';
        document.getElementById('edit_status').value       = status || 'Menunggu';
        document.getElementById('edit_idpet').value        = idpet || '';
        document.getElementById('edit_idpemilik').value    = idpemilik || '';
        document.getElementById('edit_dokter_id').value    = dokterId || '';
        document.getElementById('edit_keluhan').value      = keluhan || '';

        const form = document.getElementById('formEditTemu');
        form.action = '/resepsionis/temudokter/update/' + id;

        document.getElementById('modalEditTemu').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('modalEditTemu').classList.remove('show');
    }

    // ================= DELETE =================
    function deleteTemuDokter(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data temu dokter ini?')) {
            window.location.href = '/resepsionis/temudokter/delete/' + id;
        }
    }

    // ================= CLOSE MODAL ON OUTSIDE CLICK =================
    window.addEventListener('click', function (e) {
        const modalAdd  = document.getElementById('modalAddTemu');
        const modalEdit = document.getElementById('modalEditTemu');

        if (e.target === modalAdd)  closeAddModal();
        if (e.target === modalEdit) closeEditModal();
    });


    /*  
    ============================================
      ⬇⬇ TAMBAHKAN CODE AUTO-FILL DI SINI ⬇⬇
    ============================================
    */

    // ================= AUTO-FILL PEMILIK (ADD) =================
    document.getElementById('add_idpet').addEventListener('change', function () {
        let id = this.value;
        if (!id) return;

        fetch(`/resepsionis/pet/get/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('add_idpemilik').value = data.idpemilik;
            });
    });

    // ================= AUTO-FILL PEMILIK (EDIT) =================
    document.getElementById('edit_idpet').addEventListener('change', function () {
        let id = this.value;
        if (!id) return;

        fetch(`/resepsionis/pet/get/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('edit_idpemilik').value = data.idpemilik;
            });
    });

// ==================== FILTER DOKTER BERDASARKAN TANGGAL ====================
document.getElementById('add_tanggal_temu').addEventListener('change', function () {
    let tanggal = this.value;

    fetch(`/ajax/get-dokter-by-date?tanggal=${tanggal}`)
        .then(res => res.json())
        .then(data => {
            let dropdown = document.getElementById('add_dokter_id');
            dropdown.innerHTML = '';

            if (data.length === 0) {
                dropdown.innerHTML = `<option value="">Tidak ada dokter di hari ini</option>`;
                return;
            }

            dropdown.innerHTML = `<option value="">-- Pilih Dokter --</option>`;

            data.forEach(d => {
                dropdown.innerHTML += `
                    <option value="${d.iduser}">
                        ${d.nama} (${d.jam_mulai} - ${d.jam_selesai})
                    </option>`;
            });
        })
        .catch(() => {
            document.getElementById('add_dokter_id').innerHTML =
                `<option value="">Gagal memuat data dokter</option>`;
        });
});


</script>

</body>
</html>
