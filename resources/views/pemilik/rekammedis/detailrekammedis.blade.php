<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Rekam Medis | Pemilik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(180deg,#ffffff 0%,#fff7ef 20%,#ffe6bf 50%,#ffcf86 80%,#ffb74a 100%);
            background-attachment: fixed;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255,200,80,0.25), transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(255,160,40,0.2), transparent 60%);
            z-index: -1;
        }

        /* NAVBAR PEMILIK */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: linear-gradient(135deg,#102f76 0%,#142a46 100%);
            color: white;
            padding: 15px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }

        .nav-left { display:flex; align-items:center; gap:12px; }
        .nav-logo {
            font-size: 30px;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
        }

        .nav-right { display:flex; align-items:center; gap:16px; }
        .user-avatar {
            width:34px; height:34px; border-radius:50%;
            background:#f9a01b; color:#102f76;
            display:flex; align-items:center; justify-content:center;
            font-weight:bold;
        }

        /* CONTAINER */
        .container {
            max-width: 1200px;
            margin: 40px auto 100px;
            padding: 20px;
            animation: fadeIn .4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .title-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .title-header h1 {
            font-size: 36px;
            color: #102f76;
            font-weight: 800;
        }
        .title-icon {
            font-size: 70px;
            color: #102f76;
            background: #f9a01b33;
            padding: 22px;
            border-radius: 50%;
            display: inline-block;
        }

        /* CARD */
        .card {
            background: #ffffffd9;
            backdrop-filter: blur(10px);
            padding: 28px 28px;
            border-radius: 22px;
            margin-bottom: 30px;

            box-shadow:
                inset 0 2px 5px rgba(255,255,255,0.7),
                inset 0 -3px 6px rgba(0,0,0,0.06),
                0 6px 22px rgba(0,0,0,0.14);

            border: 1px solid #f2d9a5;

            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 8px;
            height: 100%;
            background: #f9a01b;
            border-radius: 8px 0 0 8px;
        }

        .card h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #102f76;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card h2 i {
            font-size: 22px;
            color: #f9a01b;
            background: #fff3d4;
            padding: 8px;
            border-radius: 10px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 30px;
        }

        .info-grid div {
            padding-bottom: 10px;
            border-bottom: 1px dashed #e6c98f;
        }

        .label {
            font-size: 13px;
            color: #102f76;
            opacity: .82;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .value {
            font-size: 15px;
            font-weight: 600;
            color: #2a2a2a;
            background: #fff5df;
            padding: 6px 12px;
            border-radius: 10px;
            margin-top: 4px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.08);
        }

        .paw-icon {
            position: absolute;
            right: 16px;
            top: 16px;
            font-size: 28px;
            color: #f9a01b;
            opacity: .22;
        }

        .btn-back {
            display: inline-flex;
            align-items:center;
            gap:8px;
            background:#102f76;
            color:white;
            padding:12px 22px;
            text-decoration:none;
            border-radius:14px;
            font-weight:600;
            box-shadow:0 5px 18px rgba(0,0,0,0.25);
        }
        .btn-back:hover { transform: translateY(-2px); }
    </style>
</head>
<body>


<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <i class="bi bi-hospital nav-logo"></i>
        <div>
            <div style="font-weight:700;">Klinik Hewan</div>
            <div style="font-size:12px; opacity:.8;">Panel Pemilik</div>
        </div>
    </div>

    <div class="nav-right">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->nama,0,1)) }}</div>
        <div style="text-align:right;">
            <div style="font-size:13px; font-weight:600;">{{ auth()->user()->nama }}</div>
            <div style="font-size:11px; opacity:.8;">Pemilik Hewan</div>
        </div>
        <a href="{{ route('logout') }}" class="btn-back" style="padding:8px 16px;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>


<div class="container">

    <div class="title-header">
        <i class="bi bi-file-medical title-icon"></i>
        <h1>Detail Rekam Medis</h1>
    </div>

    <!-- =============== INFORMASI HEWAN =============== -->
    <div class="card">
        <i class="bi bi-paw-fill paw-icon"></i>
        <h2><i class="bi bi-paw"></i> Informasi Hewan</h2>

        <div class="info-grid">
            <div>
                <div class="label">Nama Hewan</div>
                <div class="value">{{ $detail->nama_hewan ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Jenis Hewan</div>
                <div class="value">{{ $detail->nama_jenis_hewan ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Ras Hewan</div>
                <div class="value">{{ $detail->nama_ras ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Jenis Kelamin</div>
                <div class="value">{{ $detail->jenis_kelamin ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Usia</div>
                <div class="value">{{ $detail->umur ?? '-' }} bulan</div>
            </div>

            <div>
                <div class="label">Tanggal Kunjungan</div>
                <div class="value">{{ $detail->tanggal_temu ?? '-' }}</div>
            </div>
        </div>
    </div>


    <!-- =============== KELUHAN =============== -->
    <div class="card">
        <i class="bi bi-chat-left-heart paw-icon"></i>
        <h2><i class="bi bi-chat-left-heart"></i> Keluhan Saat Datang</h2>
        <div class="value">{{ $detail->keluhan ?? '-' }}</div>
    </div>


    <!-- =============== DATA PERAWAT =============== -->
    <div class="card">
        <i class="bi bi-heart-pulse paw-icon"></i>
        <h2><i class="bi bi-heart-pulse"></i> Pemeriksaan Awal Perawat</h2>

        <div class="info-grid">
            <div>
                <div class="label">Anamnesa Awal</div>
                <div class="value">{{ $detail->anamnesa_awal ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Suhu Tubuh</div>
                <div class="value">{{ $detail->suhu ?? '-' }} °C</div>
            </div>

            <div>
                <div class="label">Nadi</div>
                <div class="value">{{ $detail->nadi ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Berat Badan</div>
                <div class="value">{{ $detail->berat_badan ?? '-' }} kg</div>
            </div>

            <div>
                <div class="label">Perilaku Hewan</div>
                <div class="value">{{ $detail->perilaku_hewan ?? '-' }}</div>
            </div>
        </div>
    </div>


    <!-- =============== DATA DOKTER =============== -->
    <div class="card">
        <i class="bi bi-stethoscope paw-icon"></i>
        <h2><i class="bi bi-stethoscope"></i> Pemeriksaan Dokter</h2>

        <div class="info-grid">
            <div>
                <div class="label">Anamnesa Dokter</div>
                <div class="value">{{ $detail->anamnesa ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Diagnosa</div>
                <div class="value">{{ $detail->diagnosa ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Tindakan Medis</div>
                <div class="value">{{ $detail->temuan_klinis ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Resep / Terapi</div>
                <div class="value">{{ $detail->resep ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Kategori Klinis</div>
                <div class="value">{{ $detail->nama_kategori_klinis ?? '-' }}</div>
            </div>

            <div>
                <div class="label">Kategori Tindakan</div>
                <div class="value">{{ $detail->nama_tindakan ?? '-' }}</div>
            </div>
        </div>
    </div>

    <br>
    <a href="{{ route('pemilik.rekammedis.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Rekam Medis
    </a>

</div>

</body>
</html>
