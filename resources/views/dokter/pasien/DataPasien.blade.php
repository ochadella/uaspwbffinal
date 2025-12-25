<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien | Dokter</title>

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* =====================================================
           🌟 BACKGROUND GRADIENT (IDENTIK DASHBOARD DOKTER)
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

        /* ================= NAVBAR ================= */
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
            display:flex;
            align-items:center;
            gap:12px;
        }

        .nav-logo {
            font-size: 30px;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }

        .brand-text-title { font-size:18px; font-weight:700; }
        .brand-text-sub { font-size:12px; opacity:0.8; }

        .nav-center {
            flex:1;
            display:flex;
            justify-content:center;
            padding:0 40px;
        }

        .nav-search {
            display:flex;
            align-items:center;
            gap:8px;
            background:#ffffff;
            border-radius:999px;
            padding:6px 14px;
            min-width:280px;
            max-width:420px;
            box-shadow:0 4px 10px rgba(0,0,0,0.15);
        }

        .nav-search input {
            border:none;
            outline:none;
            width:100%;
            font-size:13px;
        }

        .nav-right {
            display:flex;
            align-items:center;
            gap:16px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f9a01b;
            color: #102f76;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.35);
            flex-shrink: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.1;
        }

        .user-role {
            font-size: 12px;
            opacity: .8;
            line-height: 1.1;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-name { font-size:13px; font-weight:600; }
        .user-role { font-size:11px; opacity:.8; }

        .btn-logout {
            padding:7px 14px;
            border-radius:999px;
            background:#f5594b;
            color:#ffffff;
            font-size:12px;
            font-weight:600;
            text-decoration:none;
            box-shadow:0 4px 12px rgba(245,89,75,0.5);
        }

        /* ================= LAYOUT ================= */
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

        /* ================= CONTENT WRAPPER ================= */
        .content {
            flex:1;
            background:rgba(255,255,255,0.78);
            backdrop-filter:blur(16px);
            border-radius:20px;
            padding:32px 36px 40px;
            box-shadow:0 12px 35px rgba(0,0,0,0.15);
            animation:fadeIn .45s ease;
        }
        @keyframes fadeIn {
            from { opacity:0; transform:translateY(15px); }
            to { opacity:1; transform:translateY(0); }
        }

        /* ================= PAGE HEADER ================= */
        .page-header {
            text-align:center;
            margin-bottom:20px;
        }

        .page-header-icon {
            font-size:54px;
            color:#102f76;
            background:#f9a01b33;
            padding:20px;
            border-radius:50%;
            display:inline-block;
        }

        .page-header h1 {
            font-size:34px;
            margin-top:18px;
            font-weight:800;
            color:#102f76;
        }

        .page-header p { color:#555; font-size:14px; }

        /* ================= TABLE ================= */
        table {
            width:100%;
            border-collapse:collapse;
            margin-top:28px;
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 10px 26px rgba(0,0,0,0.10);
        }

        th {
            background:linear-gradient(135deg,#102f76 0%, #142a46 100%);
            color:#f9a01b;
            padding:15px;
            text-align:center;
            font-size:16px;
        }

        td {
            padding:14px;
            background:rgba(255,255,255,0.82);
            border-bottom:1px solid rgba(0,0,0,0.05);
            text-align:center;
            font-size:15px;
        }

        tr:hover td {
            background:rgba(249,160,27,0.13);
        }

        /* ================= BUTTON REKAM ================= */
        .btn-detail {
            padding:7px 14px;
            border-radius:999px;
            background:#f9a01b;
            color:#102f76;
            font-weight:700;
            font-size:13px;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:6px;
            box-shadow:0 4px 12px rgba(249,160,27,0.35);
        }

        .btn-detail:hover {
            transform:translateY(-2px);
        }

        /* ============= MODAL REKAM DOKTER ================== */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            justify-content: center;
            align-items: center;
            z-index: 4000;
        }

        .modal.show {
            display: flex;
        }

        .modal-box {
            width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.25);
            animation: fadeIn 0.3s ease;
        }

        .modal-box h2 {
            margin-bottom: 12px;
            color: #102f76;
            font-weight: 800;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-box label {
            font-weight: 600;
            margin-top: 12px;
            margin-bottom: 4px;
            display: block;
            color: #102f76;
        }

        .modal-box input,
        .modal-box textarea,
        .modal-box select {
            width: 100%;
            padding: 9px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .modal-box textarea {
            min-height: 70px;
            resize: vertical;
        }

        .modal-section-title {
            margin-top: 20px;
            font-weight: 700;
            color: #102f76;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
            margin-bottom: 4px;
        }

        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-close-modal {
            padding: 10px 18px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-save-modal {
            padding: 10px 18px;
            background: #f9a01b;
            border: none;
            color: #102f76;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
        }

    </style>
</head>
<body>

@php
    $user = auth()->user();
    $displayName = $user->nama ?? $user->name ?? "User";
    $initial = strtoupper(mb_substr($displayName, 0, 1));
@endphp

<!-- ================= NAVBAR ================= -->
<div class="navbar">

    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div class="brand-text-title">Klinik Hewan</div>
            <div class="brand-text-sub">Panel Dokter</div>
        </div>
    </div>

    <div class="nav-center">
        <div class="nav-search">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari pasien...">
        </div>
    </div>

    <div class="nav-right">
        <div class="user-avatar">{{ $initial }}</div>
        <div class="user-info">
            <div class="user-name">{{ $displayName }}</div>
            <div class="user-role">Dokter</div>
        </div>
        <a href="{{ route('logout') }}" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

</div>

<!-- ================= LAYOUT ================= -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="{{ route('interface.dashboard_dokter') }}" style="text-decoration: none; color: inherit;">
            <div class="sidebar-header">
                <div class="sidebar-header-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </div>
                <div>
                    <div class="sidebar-header-title">Dashboard Dokter</div>
                    <div class="sidebar-header-sub">Panel Dokter Klinik</div>
                </div>
            </div>
        </a>

        <hr class="sidebar-divider">

        <div class="sidebar-section-title">Menu Utama</div>
        <div class="sidebar-menu">
            <a href="{{ route('interface.dashboard_dokter') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
        </div>

        <div class="sidebar-section-title">Manajemen</div>
        <div class="sidebar-menu">
            <a href="{{ route('dokter.rekammedis.index') }}" class="sidebar-link">
                <i class="bi bi-journal-medical"></i> <span>Data Rekam Medis</span>
            </a>

            <a href="{{ route('dokter.pasien.index') }}" class="sidebar-link active">
                <i class="bi bi-people-fill"></i> <span>Data Pasien</span>
            </a>

            <a href="{{ route('dokter.jadwal.index') }}" class="sidebar-link">
                <i class="bi bi-calendar-check"></i> <span>Jadwal Pemeriksaan</span>
            </a>

            <a href="{{ route('dokter.jenishewan.index') }}" class="sidebar-link">
                <i class="bi bi-bug"></i> <span>Data Jenis Hewan</span>
            </a>

            <a href="{{ route('dokter.rashewan.index') }}" class="sidebar-link">
                <i class="bi bi-bug-fill"></i> <span>Data Ras Hewan</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>
    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="content">

        <div class="page-header">
            <i class="bi bi-clipboard-heart page-header-icon"></i>
            <h1>Data Pasien Pemeriksaan</h1>
            <p>Daftar pasien hewan yang terdaftar untuk konsultasi dokter.</p>
        </div>

        <!-- ================= TABLE PASIEN ================= -->
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Hewan</th>
                <th>Jenis Hewan</th>
                <th>Ras</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Pemilik</th>
                <th>Tanggal Kunjungan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($pasien as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nama_hewan }}</td>
                    <td>{{ $p->jenis_hewan }}</td>
                    <td>{{ $p->ras }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->umur }} bln</td>
                    <td>{{ $p->nama_pemilik }}</td>
                    <td>{{ $p->tanggal_kunjungan }}</td>
                    <td>{{ $p->status }}</td>
                    <td>
                        <!-- 🔥 BUTTON REKAM (BUKAN DETAIL) -->
                        <a href="javascript:void(0)"
                          class="btn-detail"
                          onclick="openRekamModal(this)"
                          data-id="{{ $p->idreservasi }}"
                          data-hewan="{{ $p->nama_hewan }}"
                          data-jenis="{{ $p->jenis_hewan }}"
                          data-ras="{{ $p->ras }}"
                          data-kelamin="{{ $p->jenis_kelamin }}"
                          data-umur="{{ $p->umur }}"
                          data-pemilik="{{ $p->nama_pemilik }}"
                          data-tanggal="{{ $p->tanggal_kunjungan }}"
                          data-status="{{ $p->status }}"
                          data-anamnesa="{{ $p->anamnesa_awal }}"
                          data-suhu="{{ $p->suhu }}"
                          data-nadi="{{ $p->nadi }}"
                          data-berat="{{ $p->berat_badan }}"
                          data-perilaku="{{ $p->perilaku_hewan }}"
                          data-anamnesa_dokter="{{ $p->anamnesa }}"
                          data-diagnosa="{{ $p->diagnosa }}"
                          data-tindakan_dokter="{{ $p->temuan_klinis }}"
                          data-resep="{{ $p->resep ?? '' }}"
                          data-kategori_klinis="{{ $p->kategori_klinis ?? '' }}"
                          data-kategori_tindakan="{{ $p->kategori_tindakan ?? '' }}"
                          data-status_rekam="{{ $p->status }}"
                        >
                            <i class="bi bi-clipboard2-pulse"></i> Rekam
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center;color:#666;">Belum ada data pasien.</td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div>

</div>


<!-- ======================= MODAL REKAM DOKTER ======================= -->
<div id="modalRekam" class="modal">
    <div class="modal-box">

        <h2><i class="bi bi-clipboard2-pulse"></i> Rekam Pemeriksaan Dokter</h2>

        <form method="POST" action="{{ route('dokter.rekammedis.store') }}">
            @csrf

            <!-- status akhir setelah dokter simpan -->
            <input type="hidden" name="ubah_status_ke" value="Selesai">

            <!-- ID Temu Dokter (reservasi) -->
            <input type="hidden" id="rekam_id_hidden" name="idtemu_dokter">

            <div class="modal-section-title">Data Pasien</div>

            <label>ID Reservasi</label>
            <input id="rekam_id_display" readonly>

            <label>Nama Hewan</label>
            <input id="rekam_hewan" readonly>

            <label>Jenis Hewan</label>
            <input id="rekam_jenis" readonly>

            <label>Ras</label>
            <input id="rekam_ras" readonly>

            <label>Jenis Kelamin</label>
            <input id="rekam_kelamin" readonly>

            <label>Usia</label>
            <input id="rekam_umur" readonly>

            <label>Pemilik</label>
            <input id="rekam_pemilik" readonly>

            <label>Tanggal Kunjungan</label>
            <input id="rekam_tanggal" readonly>

            <label>Status Saat Ini</label>
            <input id="rekam_status" readonly>

            <div class="modal-section-title">Data Awal (Perawat)</div>

            <!-- Diisi dari rekam_medis.anamnesa_awal lewat data-anamnesa -->
            <label>Anamnesa Awal</label>
            <textarea id="rekam_anamnesa_perawat" readonly placeholder="Anamnesa awal dari perawat akan ditampilkan di sini jika sudah ada."></textarea>

            <label>Suhu (°C)</label>
            <input id="rekam_suhu_perawat" readonly>

            <label>Nadi</label>
            <input id="rekam_nadi_perawat" readonly>

            <label>Berat Badan (kg)</label>
            <input id="rekam_berat_perawat" readonly>

            <label>Perilaku Hewan</label>
            <input id="rekam_perilaku_perawat" readonly>

            <div class="modal-section-title">Pemeriksaan Dokter</div>

            <label>Anamnesa Dokter</label>
            <textarea name="anamnesa"></textarea>

            <label>Diagnosa</label>
            <textarea name="diagnosa" required></textarea>

            <label>Tindakan Medis</label>
            <textarea name="tindakan"></textarea>

            <label>Resep / Terapi</label>
            <textarea name="resep"></textarea>

            <label>Kategori Klinis</label>
            <select name="kategori_klinis">
                <option value="">-- Pilih Kategori Klinis --</option>
                @foreach ($kategoriKlinis as $k)
                    <option value="{{ $k->idkategori_klinis }}">{{ $k->nama_kategori_klinis }}</option>
                @endforeach
            </select>

            <label>Kategori Tindakan</label>
            <select name="kategori_tindakan">
                <option value="">-- Pilih Kategori Tindakan --</option>
                @foreach ($kategoriTindakan as $t)
                    <option value="{{ $t->id }}">{{ $t->nama_tindakan }}</option>
                @endforeach
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-close-modal" onclick="closeRekamModal()">Batal</button>
                <button type="submit" class="btn-save-modal">Simpan Pemeriksaan</button>
            </div>

        </form>

    </div>
</div>

<script>
function openRekamModal(el) {
    const id       = el.dataset.id;
    const hewan    = el.dataset.hewan;
    const jenis    = el.dataset.jenis;
    const ras      = el.dataset.ras;
    const kelamin  = el.dataset.kelamin;
    const umur     = el.dataset.umur;
    const pemilik  = el.dataset.pemilik;
    const tanggal  = el.dataset.tanggal;
    const status   = el.dataset.status;

    document.getElementById('rekam_id_hidden').value   = id;
    document.getElementById('rekam_id_display').value  = id;
    document.getElementById('rekam_hewan').value       = hewan;
    document.getElementById('rekam_jenis').value       = jenis;
    document.getElementById('rekam_ras').value         = ras;
    document.getElementById('rekam_kelamin').value     = kelamin;
    document.getElementById('rekam_umur').value        = umur + " bulan";
    document.getElementById('rekam_pemilik').value     = pemilik;
    document.getElementById('rekam_tanggal').value     = tanggal;
    document.getElementById('rekam_status').value      = status;

    // ambil anamnesa awal dari data attribute (hasil join rekam_medis)
    const anamnesaPerawat = el.dataset.anamnesa || "";
    document.getElementById('rekam_anamnesa_perawat').value = anamnesaPerawat;

    // Data vital perawat
    document.getElementById('rekam_suhu_perawat').value = el.dataset.suhu || "-";
    document.getElementById('rekam_nadi_perawat').value = el.dataset.nadi || "-";
    document.getElementById('rekam_berat_perawat').value = el.dataset.berat || "-";
    document.getElementById('rekam_perilaku_perawat').value = el.dataset.perilaku || "-";

// ===============================
// 🔥 ISI DATA PEMERIKSAAN DOKTER JIKA SUDAH ADA
// ===============================
document.querySelector('textarea[name="anamnesa"]').value =
    el.dataset.anamnesa_dokter || "";

document.querySelector('textarea[name="diagnosa"]').value =
    el.dataset.diagnosa || "";

document.querySelector('textarea[name="tindakan"]').value =
    el.dataset.tindakan_dokter || "";


// =======================================
// 🔥 FIX UTAMA: PARSE temuan_klinis supaya 3 field muncul
// =======================================
let allText = el.dataset.tindakan_dokter || "";   // seluruh isi temuan_klinis


// ----------------------
// 1️⃣ Resep / Terapi
// ----------------------
let resepMatch = allText.match(/Resep\s*\/\s*Terapi:\s*([\s\S]*?)(?=\n[A-Z]|$)/i);
document.querySelector('textarea[name="resep"]').value =
    resepMatch ? resepMatch[1].trim() : (el.dataset.resep || "");


// ----------------------
// 2️⃣ Kategori Klinis
// ----------------------
let klinisMatch = allText.match(/Kategori Klinis:\s*(.*)/i);
document.querySelector('select[name="kategori_klinis"]').value =
    klinisMatch ? klinisMatch[1].trim() : (el.dataset.kategori_klinis ?? "");


// ----------------------
// 3️⃣ Kategori Tindakan
// ----------------------
let tindakanMatch = allText.match(/Kategori Tindakan:\s*(.*)/i);
document.querySelector('select[name="kategori_tindakan"]').value =
    tindakanMatch ? tindakanMatch[1].trim() : (el.dataset.kategori_tindakan ?? "");


// ===============================
// 🔥 LOCK FORM JIKA STATUS = SELESAI
// ===============================
const formSudahSelesai = el.dataset.status_rekam === "Selesai";

if (formSudahSelesai) {
    // Lock semua textarea dokter
    document.querySelectorAll(
        'textarea[name="anamnesa"], textarea[name="diagnosa"], textarea[name="tindakan"], textarea[name="resep"]'
    ).forEach(t => t.setAttribute('readonly', true));

    // Lock dropdown kategori
    document.querySelector('select[name="kategori_klinis"]').disabled = true;
    document.querySelector('select[name="kategori_tindakan"]').disabled = true;

    // Ubah tombol simpan
    const btn = document.querySelector('.btn-save-modal');
    btn.textContent = "Sudah Disimpan";
    btn.style.background = "#888";
    btn.disabled = true;
} else {
    // Jika belum selesai, pastikan tombol kembali NORMAL
    const btn = document.querySelector('.btn-save-modal');
    btn.textContent = "Simpan Pemeriksaan";
    btn.style.background = "#f9a01b";
    btn.disabled = false;
}

// buka modal terakhir
document.getElementById('modalRekam').classList.add('show');
}

function closeRekamModal() {
document.getElementById('modalRekam').classList.remove('show');
}

window.onclick = function(event) {
const modal = document.getElementById('modalRekam');
if (event.target === modal) closeRekamModal();
}
</script>


</body>
</html>
