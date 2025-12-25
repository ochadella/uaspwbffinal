<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi Pemilik</title>

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
            color: #102f76;
            font-weight: 800;
            margin-bottom: 0;
        }

        .page-header p {
            margin-top: 8px;
            color: #555;
            font-size: 14px;
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
            width: 420px;
            background: white;
            padding: 26px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-box h2 {
            text-align: center;
            color: #102f76;
            margin-top: 0;
        }

        .modal-box label {
            font-weight: 600;
            color: #102f76;
            display: block;
            margin-top: 12px;
        }

        .modal-box input,
        .modal-box textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 6px;
            font-size: 14px;
        }

        .modal-box textarea {
            resize: vertical;
            min-height: 70px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 10px 16px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        .btn-submit {
            padding: 10px 16px;
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: 700;
            border-radius: 8px;
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
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
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
            <a href="{{ route('resepsionis.pemilik') }}" class="sidebar-link active">
                <i class="bi bi-person-vcard"></i> <span>Registrasi Pemilik</span>
            </a>
            <a href="{{ route('resepsionis.pet.regris') }}" class="sidebar-link">
                <i class="bi bi-bag-heart"></i> <span>Registrasi Pet</span>
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
        <div class="content">
            
            <!-- HEADER TENGAH -->
            <div class="page-header">
                <i class="bi bi-person-vcard page-header-icon"></i>
                <h1>Registrasi Pemilik</h1>
                <p>Daftar pemilik hewan yang terdaftar dalam sistem.</p>
            </div>

            <!-- BUTTONS -->
            <button type="button" class="btn-add" onclick="openAddModal()">+ Tambah Pemilik</button>
            <a href="{{ route('dashboard.resepsionis') }}" class="btn-back">← Kembali</a>

            <!-- TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No WA</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pemilik as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->no_wa }}</td>
                            <td>{{ $p->alamat }}</td>

                            <td>
                                <div class="action-icons">
                                    <!-- EDIT -->
                                    <a href="javascript:void(0)"
                                       class="icon-btn"
                                       title="Edit Pemilik"
                                       onclick="openEditModal(this)"
                                       data-id="{{ $p->idpemilik }}"
                                       data-nama="{{ $p->nama }}"
                                       data-email="{{ $p->email }}"
                                       data-wa="{{ $p->no_wa }}"
                                       data-alamat="{{ $p->alamat }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <a href="javascript:void(0)"
                                       class="icon-btn delete"
                                       title="Hapus Pemilik"
                                       onclick="deletePemilik('{{ $p->idpemilik }}')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#555;">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- ==================== MODAL TAMBAH PEMILIK ==================== -->
<div id="modalAdd" class="modal">
    <div class="modal-box">
        <h2>Tambah Pemilik</h2>

        <form method="POST" action="{{ route('resepsionis.pemilik.store') }}" id="formAddPemilik">
            @csrf

            <label>Nama *</label>
            <input type="text" name="nama" id="add_nama" required placeholder="Nama pemilik">

            <label>Email *</label>
            <input type="email" name="email" id="add_email" required placeholder="Email pemilik">

            <label>No WA *</label>
            <input type="text" name="no_wa" id="add_no_wa" required placeholder="Nomor WhatsApp">
            @error('no_wa')
                <div style="color:red; font-size:12px; margin-top:4px;">
                    {{ $message }}
                </div>
            @enderror


            <label>Alamat *</label>
            <textarea name="alamat" id="add_alamat" required placeholder="Alamat lengkap"></textarea>

            <div class="modal-buttons">
                <button type="button" onclick="closeAddModal()" class="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT PEMILIK ==================== -->
<div id="modalEdit" class="modal">
    <div class="modal-box">
        <h2>Edit Pemilik</h2>

        <form method="POST" action="" id="formEditPemilik">
            @csrf
            <input type="hidden" name="edit_id" id="edit_id">

            <label>Nama *</label>
            <input type="text" name="nama" id="edit_nama" required>

            <label>Email *</label>
            <input type="email" name="email" id="edit_email" required>

            <label>No WA *</label>
            <input type="text" name="no_wa" id="edit_no_wa" required>
            @error('no_wa')
                <div style="color:red; font-size:12px; margin-top:4px;">
                    {{ $message }}
                </div>
            @enderror

            @if ($errors->has('no_wa'))
                <div style="color:#b00020; font-size:13px; margin-top:4px;">
                    {{ $errors->first('no_wa') }}
                </div>
            @endif

            @if ($errors->has('no_wa'))
                <div style="color:#b00020; font-size:13px; margin-top:4px;">
                    {{ $errors->first('no_wa') }}
                </div>
            @endif

            <label>Alamat *</label>
            <textarea name="alamat" id="edit_alamat" required></textarea>

            <div class="modal-buttons">
                <button type="button" onclick="closeEditModal()" class="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== FORM TERSEMBUNYI UNTUK DELETE ==================== -->
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // MODAL TAMBAH
    function openAddModal() {
        document.getElementById('add_nama').value = '';
        document.getElementById('add_email').value = '';
        document.getElementById('add_no_wa').value = '';
        document.getElementById('add_alamat').value = '';
        document.getElementById('modalAdd').classList.add('show');
    }

    function closeAddModal() {
        document.getElementById('modalAdd').classList.remove('show');
        document.getElementById('formAddPemilik').reset();
    }

    // MODAL EDIT
    function openEditModal(el) {
        const id     = el.getAttribute('data-id');
        const nama   = el.getAttribute('data-nama');
        const email  = el.getAttribute('data-email');
        const no_wa  = el.getAttribute('data-wa');
        const alamat = el.getAttribute('data-alamat');

        document.getElementById('edit_id').value      = id;
        document.getElementById('edit_nama').value    = nama;
        document.getElementById('edit_email').value   = email;
        document.getElementById('edit_no_wa').value   = no_wa;
        document.getElementById('edit_alamat').value  = alamat;

        const form = document.getElementById('formEditPemilik');
        form.action = '/resepsionis/pemilik/update/' + id;

        document.getElementById('modalEdit').classList.add('show');
    }

    function closeEditModal() {
        document.getElementById('modalEdit').classList.remove('show');
        document.getElementById('formEditPemilik').reset();
    }

    // DELETE PEMILIK
    function deletePemilik(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data pemilik ini?')) {
            const form = document.getElementById('deleteForm');
            form.action = '/resepsionis/pemilik/delete/' + id;
            form.submit();
        }
    }

    // TUTUP MODAL KALAU KLIK DI LUAR BOX
    window.onclick = function(event) {
        const modalAdd = document.getElementById('modalAdd');
        const modalEdit = document.getElementById('modalEdit');

        if (event.target === modalAdd) {
            closeAddModal();
        }
        if (event.target === modalEdit) {
            closeEditModal();
        }
    }
</script>

<script>
    // Jika validasi gagal di modal TAMBAH → buka modal tambah otomatis
    @if ($errors->any() && old('edit_id') === null)
        window.addEventListener('load', function() {
            document.getElementById('modalAdd').classList.add('show');
        });
    @endif

    // Jika validasi gagal di modal EDIT → buka modal edit otomatis
    @if ($errors->any() && old('edit_id') !== null)
        window.addEventListener('load', function() {
            document.getElementById('modalEdit').classList.add('show');

            // Isi ulang field modal edit
            document.getElementById('edit_id').value     = "{{ old('edit_id') }}";
            document.getElementById('edit_nama').value   = "{{ old('nama') }}";
            document.getElementById('edit_email').value  = "{{ old('email') }}";
            document.getElementById('edit_no_wa').value  = "{{ old('no_wa') }}";
            document.getElementById('edit_alamat').value = "{{ old('alamat') }}";

            document.getElementById('formEditPemilik').action =
                "/resepsionis/pemilik/update/" + "{{ old('edit_id') }}";
        });
    @endif
</script>


</body>
</html>
