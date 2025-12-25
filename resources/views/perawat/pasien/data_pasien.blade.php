<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien | Perawat</title>

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
            opacity: 0.8;
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

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 32px 36px 40px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.45s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
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

        .btn-back {
            padding: 10px 18px;
            background: #f9a01b;
            color: #102f76;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(249,160,27,0.35);
            font-size: 14px;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(249,160,27,0.45);
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
            font-size: 15px;
        }

        tr:hover td {
            background: rgba(249,160,27,0.13);
        }

        /* ================= ACTION BUTTON ================= */
        .btn-rekam {
            padding: 8px 14px;
            background: linear-gradient(135deg, #102f76, #1a4494);
            color: #fff;
            text-decoration: none;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(10,40,90,0.35);
            transition: 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-rekam:hover {
            transform: scale(1.05);
            background: #1a4494;
        }

        .btn-rekam.disabled {
            background: #9ca3af;
            box-shadow: none;
            cursor: default;
            transform: none;
        }

        /* ============= MODAL REKAM MEDIS ================== */
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
            width: 600px;
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

        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: end;
            gap: 12px;
        }

        .btn-cancel {
            padding: 10px 18px;
            background: #6c757d;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-submit {
            padding: 10px 18px;
            background: #f9a01b;
            border: none;
            color: #102f76;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: default;
        }

    </style>
</head>

<body>

@php
    $user        = auth()->user();
    $displayName = $user->nama ?? $user->name ?? 'User';
    $displayRole = ucfirst($user->role ?? 'Perawat');
    $initial     = strtoupper(mb_substr($displayName, 0, 1));
@endphp

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

    <!-- ================= SIDEBAR ================= -->
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

        <a href="{{ route('interface.dashboard_perawat') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>

        <div class="sidebar-section-title">Manajemen</div>

        <a href="{{ route('perawat.pasien.index') }}" class="sidebar-link active">
            <i class="bi bi-people-fill"></i> <span>Data Pasien</span>
        </a>

        <a href="{{ route('perawat.pemeriksaan.index') }}" class="sidebar-link">
            <i class="bi bi-heart-pulse"></i> <span>Pemeriksaan</span>
        </a>

        <a href="{{ route('perawat.jadwal.index') }}" class="sidebar-link">
            <i class="bi bi-calendar-check"></i> <span>Jadwal Jaga</span>
        </a>

        <div class="sidebar-bottom">
            &copy; {{ date('Y') }} Klinik Hewan
        </div>

    </aside>

    <!-- ================= CONTENT ================= -->
    <div class="content">

        <div class="page-header">
            <i class="bi bi-people-fill page-header-icon"></i>
            <h1>Data Pasien Hewan</h1>
            <p>Data pasien masuk dari resepsionis hari ini.</p>
        </div>

        <a href="{{ route('perawat.dashboard') }}" class="btn-back">
            ← Kembali
        </a>

        <!-- TABLE -->
        <table>
            <thead>
                <tr>
                    <th>ID Reservasi</th>
                    <th>Nama Hewan</th>
                    <th>Jenis</th>
                    <th>Umur</th>
                    <th>Nama Pemilik</th>
                    <th>Dokter</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($pasien as $row)

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

                    // tombol rekam dikunci kalau status sudah bukan menunggu/antrian
                    $locked = !in_array($statusText, ['Menunggu', 'Dalam Antrian']);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama_hewan }}</td>
                    <td>{{ $row->jenis }}</td>
                    <td>{{ $row->umur }} bln</td>
                    <td>{{ $row->nama_pemilik }}</td>
                    <td>{{ $row->nama_dokter ?? '-' }}</td>
                    <td>{{ $row->tanggal_kunjungan }}</td>
                    <td><span class="{{ $statusClass }}">{{ $statusText }}</span></td>

                    <td>
                        <a href="javascript:void(0)"
                           class="btn-rekam {{ $locked ? 'disabled' : '' }}"
                           onclick="openRekamModal(this)"
                           data-idtemu="{{ $row->idtemu_dokter }}"
                           data-hewan="{{ $row->nama_hewan }}"
                           data-pemilik="{{ $row->nama_pemilik }}"
                           data-dokter="{{ $row->nama_dokter ?? '' }}"
                           data-status="{{ $statusText }}"
                           data-anamnesa="{{ $row->anamnesa_awal ?? '' }}"
                           data-suhu="{{ $row->suhu ?? '' }}"
                           data-nadi="{{ $row->nadi ?? '' }}"
                           data-berat="{{ $row->berat_badan ?? '' }}"
                           data-perilaku="{{ $row->perilaku_hewan ?? '' }}"
                        >
                            <i class="bi bi-clipboard2-pulse"></i>
                            {{ $locked ? 'Lihat Rekam' : 'Rekam' }}
                        </a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#555;">
                        Tidak ada data pasien.
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

    </div><!-- /content -->
</div><!-- /layout -->


<!-- ================= MODAL REKAM MEDIS ================= -->
<div id="modalRekam" class="modal">
    <div class="modal-box">

        <h2><i class="bi bi-clipboard2-pulse"></i> Input Rekam Medis</h2>

        <form method="POST" action="{{ route('perawat.rekammedis.store') }}">
            @csrf

            <!-- untuk mengubah status di backend (opsional) -->
            <input type="hidden" name="ubah_status_ke" value="Sedang Diperiksa">

            <label>ID Temu Dokter</label>
            <input type="text" id="rekam_id" name="idtemu_dokter" readonly>

            <label>Nama Hewan</label>
            <input type="text" id="rekam_nama_hewan" readonly>

            <label>Nama Pemilik</label>
            <input type="text" id="rekam_nama_pemilik" readonly>

            <label>Dokter Penanggung Jawab</label>
            <input type="text" id="rekam_nama_dokter" readonly>

            <label>Anamnesa Awal *</label>
            <input type="text" id="rekam_anamnesa" name="anamnesa_awal" readonly>

            <label>Suhu (°C) *</label>
            <input type="text" id="rekam_suhu" name="suhu" required>

            <label>Nadi *</label>
            <select id="rekam_nadi" name="nadi" required>
                <option value="">-- Pilih Kondisi Nadi --</option>
                <option value="Normal">Normal</option>
                <option value="Lemah">Lemah</option>
                <option value="Kuat">Kuat</option>
                <option value="Tidak Teratur">Tidak Teratur</option>
            </select>

            <label>Berat Badan (kg) *</label>
            <input type="number" step="0.01" id="rekam_berat" name="berat_badan" required>

            <label>Perilaku Hewan *</label>
            <select id="rekam_perilaku" name="perilaku_hewan" required>
                <option value="">-- Pilih Perilaku --</option>
                <option value="Normal">Normal</option>
                <option value="Agresif">Agresif</option>
                <option value="Lemas">Lemas</option>
                <option value="Gelisah">Gelisah</option>
            </select>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeRekamModal()">Batal</button>
                <button type="submit" class="btn-submit" id="rekam_submit">Simpan</button>
            </div>

        </form>

    </div>
</div>


<!-- ================= JS: OPEN/CLOSE MODAL ================= -->
<script>
    function openRekamModal(el) {
        const id       = el.getAttribute('data-idtemu');
        const hewan    = el.getAttribute('data-hewan');
        const pemilik  = el.getAttribute('data-pemilik');
        const dokter   = el.getAttribute('data-dokter') || '';
        const status   = el.getAttribute('data-status') || '';

        const anamnesa = el.getAttribute('data-anamnesa') || '';
        const suhu     = el.getAttribute('data-suhu') || '';
        const nadi     = el.getAttribute('data-nadi') || '';
        const berat    = el.getAttribute('data-berat') || '';
        const perilaku = el.getAttribute('data-perilaku') || '';

        const inputId       = document.getElementById('rekam_id');
        const inputHewan    = document.getElementById('rekam_nama_hewan');
        const inputPemilik  = document.getElementById('rekam_nama_pemilik');
        const inputDokter   = document.getElementById('rekam_nama_dokter');
        const txtAnamnesa   = document.getElementById('rekam_anamnesa');
        const inputSuhu     = document.getElementById('rekam_suhu');
        const selectNadi    = document.getElementById('rekam_nadi');
        const inputBerat    = document.getElementById('rekam_berat');
        const selectPerilaku= document.getElementById('rekam_perilaku');
        const submitBtn     = document.getElementById('rekam_submit');

        inputId.value      = id;
        inputHewan.value   = hewan;
        inputPemilik.value = pemilik;
        inputDokter.value  = dokter;

        txtAnamnesa.value   = anamnesa;
        inputSuhu.value     = suhu;
        selectNadi.value    = nadi;
        inputBerat.value    = berat;
        selectPerilaku.value= perilaku;

        // kalau status sudah "Sedang Diperiksa", "Selesai", atau "Batal" => form read-only
        const locked = (status !== 'Menunggu' && status !== 'Dalam Antrian');

        txtAnamnesa.readOnly    = locked;
        inputSuhu.readOnly      = locked;
        selectNadi.disabled     = locked;
        inputBerat.readOnly     = locked;
        selectPerilaku.disabled = locked;

        if (locked) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sudah Disimpan';
        } else {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Simpan';
        }

        document.getElementById('modalRekam').classList.add('show');
    }

    function closeRekamModal() {
        document.getElementById('modalRekam').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalRekam');
        if (event.target === modal) {
            closeRekamModal();
        }
    }
</script>


</body>
</html>