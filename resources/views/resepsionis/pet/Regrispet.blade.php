<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi Pet</title>

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
        .container {
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

        .modal-box input[readonly] {
            background: #f4f4f4;
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
            <input type="text" placeholder="Cari data pet...">
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
            <a href="{{ route('resepsionis.pet.regris') }}" class="sidebar-link active">
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

        <!-- HEADER TENGAH -->
        <div class="page-header">
            <i class="bi bi-bag-heart-fill page-header-icon"></i>
            <h1>Registrasi Pet</h1>
            <p>Daftar hewan peliharaan yang terdaftar dalam sistem.</p>
        </div>

        <!-- CONTENT -->
        <div class="container">

            <!-- BUTTON TAMBAH PET (BUKA MODAL) -->
            <button type="button" class="btn-add" onclick="openAddModal()">+ Tambah Pet</button>
            <a href="{{ route('dashboard.resepsionis') }}" class="btn-back">← Kembali</a>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pet</th>
                        <th>Pemilik</th>
                        <th>Ras</th>
                        <th>Jenis Kelamin</th>
                        <th>Umur (bulan)</th>
                        <th>No WA Pemilik</th>
                        <th>Alamat Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp

                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row['nama'] ?? '-' }}</td>
                            <td>{{ $row['nama_pemilik'] ?? '-' }}</td>
                            <td>{{ $row['nama_ras'] ?? '-' }}</td>
                            <td>{{ $row['jenis_kelamin'] ?? '-' }}</td>
                            <td>{{ $row['umur'] ? $row['umur'].' bln' : '-' }}</td>
                            <td>{{ $row['wa_pemilik'] ?? '-' }}</td>
                            <td>{{ $row['alamat_pemilik'] ?? '-' }}</td>

                            <td>
                                <div class="action-icons">
                                    <!-- EDIT -->
                                    <a href="javascript:void(0)"
                                    class="icon-btn"
                                    onclick="openEditModal(this)"
                                    data-idpet="{{ $row['idpet'] }}"
                                    data-nama="{{ $row['nama'] }}"
                                    data-idpemilik="{{ $row['idpemilik'] }}"
                                    data-idras="{{ $row['idras_hewan'] }}"
                                    data-jenis-kelamin="{{ $row['jenis_kelamin'] }}"
                                    data-umur="{{ $row['umur'] }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>


                                    <!-- DELETE -->
                                    <a class="icon-btn delete"
                                       href="javascript:void(0)"
                                       title="Hapus Pet"
                                       onclick="deletePet('{{ $row['idpet'] }}')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="color:#666;">Belum ada data pet</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div><!-- /container -->
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- ==================== MODAL TAMBAH PET ==================== -->
<div id="modalAddPet" class="modal">
    <div class="modal-box">
        <h2>Tambah Pet</h2>

        <form id="formAddPet" method="POST" action="{{ route('resepsionis.pet.store') }}">
            @csrf

            <label for="add_nama_pet">Nama Pet *</label>
            <input type="text"
                   id="add_nama_pet"
                   name="nama"
                   required
                   placeholder="Nama hewan">

            <label for="add_umur">Umur (bulan) *</label>
            <input type="number"
                id="add_umur"
                name="umur"
                min="0"
                required
                placeholder="Contoh: 3 (bulan)">

            <label for="add_idpemilik">Pemilik *</label>
            <select id="add_idpemilik"
                    name="idpemilik"
                    required
                    onchange="onPemilikChange(this)">
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilik as $p)
                    <option value="{{ $p->idpemilik }}"
                            data-wa="{{ $p->no_wa }}"
                            data-alamat="{{ $p->alamat }}">
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>

            <label>No WA Pemilik</label>
            <input type="text"
                   id="add_no_wa"
                   readonly
                   placeholder="Otomatis dari pemilik">

            <label>Alamat Pemilik</label>
            <textarea id="add_alamat"
                      readonly
                      placeholder="Otomatis dari pemilik"></textarea>

            <label for="add_idras">Ras *</label>
            <select id="add_idras"
                    name="idras"
                    required>
                <option value="">-- Pilih Ras --</option>
                @foreach($ras as $r)
                    <option value="{{ $r->idras }}">{{ $r->nama_ras }}</option>
                @endforeach
            </select>

            <label for="add_jenis_kelamin">Jenis Kelamin *</label>
            <select id="add_jenis_kelamin"
                    name="jenis_kelamin"
                    required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Jantan">Jantan</option>
                <option value="Betina">Betina</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT PET ==================== -->
<div id="modalEditPet" class="modal">
    <div class="modal-box">
        <h2>Edit Pet</h2>

        <form id="formEditPet" method="POST" action="">
            @csrf
            <input type="hidden" id="edit_idpet" name="idpet">

            <label for="edit_nama_pet">Nama Pet *</label>
            <input type="text"
                   id="edit_nama_pet"
                   name="nama"
                   required
                   placeholder="Nama hewan">

            <label for="edit_umur">Umur (bulan) *</label>
            <input type="number"
                id="edit_umur"
                name="umur"
                min="0"
                required
                placeholder="Contoh: 3 (bulan)">

            <label for="edit_idpemilik">Pemilik *</label>
            <select id="edit_idpemilik"
                    name="idpemilik"
                    required
                    onchange="onEditPemilikChange(this)">
                <option value="">-- Pilih Pemilik --</option>
                @foreach($pemilik as $p)
                    <option value="{{ $p->idpemilik }}"
                            data-wa="{{ $p->no_wa }}"
                            data-alamat="{{ $p->alamat }}">
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>

            <label>No WA Pemilik</label>
            <input type="text"
                   id="edit_no_wa"
                   readonly
                   placeholder="Otomatis dari pemilik">

            <label>Alamat Pemilik</label>
            <textarea id="edit_alamat"
                      readonly
                      placeholder="Otomatis dari pemilik"></textarea>

            <label for="edit_idras">Ras *</label>
            <select id="edit_idras"
                    name="idras"
                    required>
                <option value="">-- Pilih Ras --</option>
                @foreach($ras as $r)
                    <option value="{{ $r->idras }}">{{ $r->nama_ras }}</option>
                @endforeach
            </select>

            <label for="edit_jenis_kelamin">Jenis Kelamin *</label>
            <select id="edit_jenis_kelamin"
                    name="jenis_kelamin"
                    required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Jantan">Jantan</option>
                <option value="Betina">Betina</option>
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
        document.getElementById('formAddPet').reset();
        document.getElementById('add_no_wa').value = '';
        document.getElementById('add_alamat').value = '';
        document.getElementById('modalAddPet').classList.add('show');
    }

    function closeAddModal() {
        document.getElementById('modalAddPet').classList.remove('show');
    }

    function onPemilikChange(selectEl) {
        const opt = selectEl.options[selectEl.selectedIndex];
        document.getElementById('add_no_wa').value = opt.getAttribute('data-wa') || '';
        document.getElementById('add_alamat').value = opt.getAttribute('data-alamat') || '';
    }

    // ================= MODAL EDIT =================
    function openEditModal(el) {
        const idpet = el.getAttribute('data-idpet');
        const nama = el.getAttribute('data-nama');
        const umur = el.getAttribute('data-umur');
        const idpemilik = el.getAttribute('data-idpemilik');
        const idras = el.getAttribute('data-idras');
        const jenisKelamin = el.getAttribute('data-jenis-kelamin');

        document.getElementById('edit_idpet').value = idpet;
        document.getElementById('edit_nama_pet').value = nama;
        document.getElementById('edit_umur').value = umur;
        document.getElementById('edit_idpemilik').value = idpemilik;
        document.getElementById('edit_idras').value = idras;
        document.getElementById('edit_jenis_kelamin').value = jenisKelamin;

        // Trigger onchange untuk isi wa & alamat
        onEditPemilikChange(document.getElementById('edit_idpemilik'));

        const form = document.getElementById('formEditPet');
        form.action = '/resepsionis/pet/update/' + idpet;

        document.getElementById('modalEditPet').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('modalEditPet').classList.remove('show');
    }

    function onEditPemilikChange(selectEl) {
        const opt = selectEl.options[selectEl.selectedIndex];
        document.getElementById('edit_no_wa').value = opt.getAttribute('data-wa') || '';
        document.getElementById('edit_alamat').value = opt.getAttribute('data-alamat') || '';
    }

    // ================= DELETE =================
    function deletePet(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data pet ini?')) {
            window.location.href = '/resepsionis/pet/delete/' + id;
        }
    }

    // ================= CLOSE MODAL ON OUTSIDE CLICK =================
    window.addEventListener('click', function (e) {
        const modalAdd = document.getElementById('modalAddPet');
        const modalEdit = document.getElementById('modalEditPet');
        
        if (e.target === modalAdd) closeAddModal();
        if (e.target === modalEdit) closeEditModal();
    });
</script>

</body>
</html>