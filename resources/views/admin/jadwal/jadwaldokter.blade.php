<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Jadwal Dokter</title>

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
            gap: 10px;
            background: #ffffff;
            border-radius: 999px;
            padding: 3px 14px;
            min-width: 200px;
            max-width: 820px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .nav-search i {
            color: #102f76;
            font-size: 13px;
        }

        .nav-search input {
            border: none;
            outline: none;
            font-size: 12px;
            width: 600%;
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

        /* ================= LAYOUT: SIDEBAR + MAIN ================= */
        .layout {
            max-width: 1420px;
            margin: 24px auto 40px;
            display: flex;
            gap: 22px;
        }

        /* ---------- SIDEBAR (SAMA PERSIS SEPERTI DATA USER) ---------- */
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

        /* ================= STYLE UNTUK KONTEN JADWAL DOKTER ================= */
        h2 {
            color: #102f76;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
        }

        h2::after {
            content: "";
            display: block;
            width: 60%;
            margin: 10px auto 0;
            height: 4px;
            background: linear-gradient(90deg, #f9a01b, #ffbb56);
            border-radius: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,0,.12);
            margin-bottom: 26px;
        }

        label { font-weight: 600; display: block; margin-bottom: 6px; }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 14px;
        }

        button {
            background: #f9a01b;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 700;
            color: #102f76;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #102f76;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        tr:nth-child(even) { background: #f8f8f8; }
        tr:hover { background: #f1f1f1; }
    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Admin');
    $initial = strtoupper(mb_substr($displayName, 0, 1));
    
    // ⭐ Tentukan route profile berdasarkan role
    $profileRoute = '#';
    if ($user && $user->role === 'admin') {
        $profileRoute = route('admin.profile');
    } elseif ($user && $user->role === 'dokter') {
        $profileRoute = route('dokter.profile');
    } elseif ($user && $user->role === 'perawat') {
        $profileRoute = route('perawat.profile');
    } elseif ($user && $user->role === 'resepsionis') {
        $profileRoute = route('resepsionis.profile');
    }
@endphp

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Administrator</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari menu atau data...">
        </div>
    </div>

    <div class="nav-right">
        <a href="{{ route('admin.profile') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit; transition: opacity 0.2s;">
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
        <a href="{{ route('admin.datamaster') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Data Master</div>
                    <div class="sidebar-header-sub">Menu administrasi sistem</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Dashboard</div>
        <div class="sidebar-menu">
            <a href="{{ route('interface.dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">User &amp; Staff</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.user.data') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i> <span>Data User</span>
            </a>
            <a href="{{ route('admin.dokter.index') }}" class="sidebar-link">
                <i class="bi bi-person-badge"></i> <span>Data Dokter</span>
            </a>
            <a href="{{ route('admin.perawat.index') }}" class="sidebar-link">
                <i class="bi bi-person-heart"></i> <span>Data Perawat</span>
            </a>
            <a href="{{ route('admin.resepsionis.index') }}" class="sidebar-link">
                <i class="bi bi-headset"></i> <span>Data Resepsionis</span>
            </a>
            <a href="{{ route('admin.role.manajemen') }}" class="sidebar-link">
                <i class="bi bi-shield-lock"></i> <span>Data Role</span>
            </a>
        </div>

        <div class="sidebar-section-title">Master Data</div>
        <div class="sidebar-menu">
            <a href="{{ route('dokter.jenis.data') }}" class="sidebar-link">
                <i class="bi bi-grid-3x3-gap-fill"></i> <span>Jenis Hewan</span>
            </a>
            <a href="{{ route('dokter.ras.data') }}" class="sidebar-link">
                <i class="bi bi-diagram-3"></i> <span>Ras Hewan</span>
            </a>
            <a href="{{ route('resepsionis.pemilik') }}" class="sidebar-link">
                <i class="bi bi-person-vcard"></i> <span>Data Pemilik</span>
            </a>
            <a href="{{ route('resepsionis.pet') }}" class="sidebar-link">
                <i class="bi bi-bag-heart"></i> <span>Data Pet</span>
            </a>
            <a href="{{ route('admin.kategori.data') }}" class="sidebar-link">
                <i class="bi bi-tag"></i> <span>Kategori</span>
            </a>
            <a href="{{ route('admin.kategoriklinis.data') }}" class="sidebar-link">
                <i class="bi bi-journal-medical"></i> <span>Kategori Klinis</span>
            </a>
            <a href="{{ route('admin.kodetindakan.data') }}" class="sidebar-link">
                <i class="bi bi-code-square"></i> <span>Kode Tindakan</span>
            </a>
        </div>

        <div class="sidebar-section-title">Manajemen Jadwal</div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.jadwal.perawat') }}" class="sidebar-link">
                <i class="bi bi-calendar2-check"></i> <span>Jadwal Perawat</span>
            </a>
            <a href="{{ route('admin.jadwal.dokter') }}" class="sidebar-link active">
                <i class="bi bi-calendar2-event"></i> <span>Jadwal Dokter</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-area">
        <div class="content">

            <h2>Manajemen Jadwal Dokter</h2>
            <p style="text-align:center;color:#555;margin-bottom:30px;">
                Admin dapat menambahkan jadwal pemeriksaan untuk dokter.
            </p>

            <!-- FORM INPUT -->
            <div class="box">
                <h3 style="margin-top:0;color:#102f76;">Tambah Jadwal Dokter</h3>

                <form action="{{ route('admin.jadwal.dokter.store') }}" method="POST">
                    @csrf

                    <label>Pilih Dokter</label>
                    <select name="iduser_dokter" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokter as $p)
                            <option value="{{ $p->iduser }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>

                    <label>Hari Praktik</label>
                    <select name="hari" required>
                        <option value="">-- Pilih Hari --</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                        <option>Sabtu</option>
                        <option>Minggu</option>
                    </select>

                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" required>

                    <label>Jam Selesai</label>
                    <input type="time" name="jam_selesai" required>

                    <label>Ruang</label>
                    <input type="text" name="ruang" placeholder="cth: Ruang 1A" required>

                    <button type="submit">Simpan Jadwal</button>
                </form>
            </div>

            <!-- TABEL -->
            <table>
                <thead>
                    <tr>
                        <th>Dokter</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Ruang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($jadwal as $j)
                    <tr>
                        <td>{{ $j->dokter->nama }}</td>
                        <td>{{ $j->tanggal }}</td>
                        <td>{{ $j->jam_mulai }}</td>
                        <td>{{ $j->jam_selesai }}</td>
                        <td>{{ $j->ruang }}</td>
                        <td>
                            <a href="#" 
                            style="color:#102f76;" 
                            onclick="openEditModal(
                                '{{ $j->id }}',
                                '{{ $j->iduser_dokter }}',
                                '{{ $j->tanggal }}',
                                '{{ $j->jam_mulai }}',
                                '{{ $j->jam_selesai }}',
                                '{{ $j->ruang }}'
                            )">
                            <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.jadwal.dokter.delete', $j->id) }}" 
                                method="POST" 
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                        onclick="return confirm('Hapus jadwal?')"
                                        style="background:none;border:none;color:red;margin-left:8px;cursor:pointer;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:20px;color:#666;">Belum ada jadwal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div><!-- /main-area -->

</div><!-- /layout -->

<!-- ✨ EDIT MODAL START -->
<div id="editModal" 
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45);
            align-items:center; justify-content:center; z-index:9999;">

    <div style="background:white; padding:24px; border-radius:12px; width:420px; box-shadow:0 6px 20px rgba(0,0,0,.2);">
        
        <h3 style="margin-top:0; color:#102f76; text-align:center;">Edit Jadwal Dokter</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label>Pilih Dokter</label>
            <select name="iduser_dokter" id="edit_dokter" required class="input">
                @foreach ($dokter as $p)
                    <option value="{{ $p->iduser }}">{{ $p->nama }}</option>
                @endforeach
            </select>

            <label>Hari Praktik</label>
            <select name="hari" id="edit_hari" required>
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
                <option>Sabtu</option>
                <option>Minggu</option>
            </select>

            <label>Jam Mulai</label>
            <input type="time" id="edit_mulai" name="jam_mulai" required>

            <label>Jam Selesai</label>
            <input type="time" id="edit_selesai" name="jam_selesai" required>

            <label>Ruang</label>
            <input type="text" id="edit_ruang" name="ruang" required>

            <div style="display:flex; gap:10px; margin-top:15px;">
                <button type="submit" style="flex:1;">Simpan</button>
                <button type="button" onclick="closeEditModal()" 
                        style="flex:1; background:#ccc; color:#333;">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, dokter, hari, mulai, selesai, ruang) {
    document.getElementById('editModal').style.display = 'flex';

    document.getElementById('edit_dokter').value = dokter;
    document.getElementById('edit_hari').value = hari;
    document.getElementById('edit_mulai').value = mulai;
    document.getElementById('edit_selesai').value = selesai;
    document.getElementById('edit_ruang').value = ruang;

    document.getElementById('editForm').action = '/admin/jadwal/dokter/update/' + id;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>
<!-- ✨ EDIT MODAL END -->


</body>
</html>