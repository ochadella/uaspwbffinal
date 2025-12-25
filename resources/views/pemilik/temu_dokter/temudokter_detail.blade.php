<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Temu Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9ff;
            display: flex;
            height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 90px;
            background: linear-gradient(180deg, #102f76, #142a46);
            padding: 30px 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 35px;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.08);
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: .3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: #f9a01b;
            color: #102f76;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
        }

        .title {
            font-size: 28px;
            font-weight: 800;
            color: #102f76;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 14px;
            opacity: .7;
            margin-bottom: 30px;
        }

        /* CARD DETAIL */
        .detail-card {
            background: white;
            padding: 26px;
            border-radius: 22px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            width: 80%;
            margin-bottom: 32px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            border-bottom: 1px solid #e7ecf7;
            padding-bottom: 14px;
        }

        .label {
            font-weight: 600;
            color: #142a46;
        }

        .value {
            font-weight: 500;
            color: #102f76;
        }

        /* STATUS BADGE */
        .status {
            padding: 6px 14px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
        }

        .done { background: #d4ffe2; color: #009f4d; }
        .wait { background: #fff7cc; color: #c28a00; }
        .cancel { background: #ffd4d4; color: #d11a1a; }

        /* BUTTON */
        .btn-back {
            background: #102f76;
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .btn-back:hover {
            background: #0b2257;
        }

    </style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="{{ route('dashboard.pemilik') }}"><i class="bi bi-house-door-fill"></i></a>
    <a href="{{ route('pemilik.profile') }}"><i class="bi bi-person-circle"></i></a>
    <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i></a>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="title">Detail Temu Dokter</div>
    <div class="subtitle">Informasi lengkap mengenai jadwal konsultasi hewan Anda</div>

    <div class="detail-card">

        <div class="detail-row">
            <div class="label">Nama Hewan</div>
            <!-- FIX VARIABLE -->
            <div class="value">{{ $detail->nama_hewan }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Dokter</div>
            <div class="value">{{ $detail->nama_dokter }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Tanggal Temu</div>
            <div class="value">{{ $detail->tanggal_temu }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Waktu Temu</div>
            <div class="value">{{ $detail->waktu_temu }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Status</div>
            <div class="value">
                @if ($detail->status == 'Selesai')
                    <span class="status done">Selesai</span>
                @elseif ($detail->status == 'Menunggu')
                    <span class="status wait">Menunggu</span>
                @else
                    <span class="status cancel">{{ $detail->status }}</span>
                @endif
            </div>
        </div>

        <div class="detail-row" style="border-bottom:none;">
            <div class="label">Keluhan</div>
            <div class="value">{{ $detail->keluhan }}</div>
        </div>

    </div>

    <!-- BACK BUTTON -->
    <a href="{{ route('pemilik.temudokter.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

</body>
</html>
