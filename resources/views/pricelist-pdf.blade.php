<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Harga - AzolaTekno</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            padding: 15px 20px;
            background: #fff;
            color: #222;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        /* ===== KOP SURAT ===== */
        .letterhead {
            border-bottom: 3px solid #1a73e8;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .letterhead .left {
            flex: 0 0 30%;
            display: flex;
            align-items: center;
        }
        .letterhead .left .logo {
            max-height: 60px;
            width: auto;
            max-width: 100%;
        }
        .letterhead .right {
            flex: 0 0 70%;
            display: flex;
            align-items: center;      /* vertikal tengah */
            justify-content: flex-end; /* rata kanan */
            text-align: right;
            font-size: 10px;
            line-height: 1.6;
            color: #444;
        }
        .letterhead .right .phone {
            font-weight: bold;
            color: #1a73e8;
            font-size: 12px;
        }

        /* ===== JUDUL ===== */
        .title-section {
            text-align: center;
            margin: 10px 0 15px 0;
        }
        .title-section h1 {
            font-size: 17px;
            color: #1a73e8;
            margin-bottom: 3px;
        }
        .title-section p {
            font-size: 11px;
            color: #555;
        }

        /* ===== TABEL ===== */
        table.price-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin: 10px 0 15px 0;
        }
        table.price-table th {
            background-color: #1a73e8;
            color: #fff;
            font-weight: bold;
            padding: 6px 4px;
            border: 1px solid #1a73e8;
            text-align: center;
        }
        table.price-table td {
            padding: 5px 4px;
            border: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
        }
        table.price-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table.price-table .product-img {
            max-width: 35px;
            max-height: 35px;
            border-radius: 3px;
        }
        table.price-table .harga {
            font-weight: bold;
            color: #1a73e8;
        }
        table.price-table .badge {
            background: #1a73e8;
            color: #fff;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 9px;
            display: inline-block;
        }

        /* ===== FOOTER ===== */
        .footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 15px;
            font-size: 9px;
            color: #888;
            text-align: center;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- ============================================================ -->
    <!-- KOP SURAT: LOGO KIRI | ALAMAT + TELEPON KANAN (SEJAJAR) -->
    <!-- ============================================================ -->
    @php
        // Logo – absolute path
        $logoPath = '/home/azolatek/public_html/img/azolatekno-square.webp';
        $logoBase64 = null;
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/webp;base64,' . base64_encode($logoData);
        } else {
            // fallback
            $logoPath2 = '/home/azolatek/public_html/img/azolatekno-square.webp';
            if (file_exists($logoPath2)) {
                $logoData = file_get_contents($logoPath2);
                $logoBase64 = 'data:image/webp;base64,' . base64_encode($logoData);
            }
        }
    @endphp

    <!-- ============================================================ -->
<!-- KOP SURAT: LOGO KIRI | NAMA + ALAMAT KANAN (SEJAJAR) -->
<!-- ============================================================ -->
<div class="letterhead">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <!-- KIRI: Logo 30% -->
            <td width="30%" valign="middle" style="max-width: 250px;">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" class="logo" style="max-width: 150px;" alt="AzolaTekno">
                @else
                    <span style="font-size:22px; font-weight:bold; color:#1a73e8;">AzolaTekno</span>
                @endif
            </td>
            <!-- KANAN: Nama + Alamat 70%, rata tengah -->
            <td width="70%" valign="middle" style="text-align: center;">
                <div style="font-size:24px; font-weight:bold; color:#1a73e8; margin-bottom:4px;">AzolaTekno</div>
                <div style="font-size:14px; color:#444; line-height:1.6;">
                    Dalon RT 03 RW 04 Sroyo, Jaten Kab. Karanganyar, Jawa Tengah<br>
                    <span style="font-weight:bold; color:#1a73e8; font-size:12px;">☎ 087733930143</span>
                </div>
            </td>
        </tr>
    </table>
</div>

    <!-- ============================================================ -->
    <!-- JUDUL HALAMAN -->
    <!-- ============================================================ -->
    <div class="title-section">
        <h1>{{ $meta->title ?? 'Daftar Harga Layanan AzolaTekno' }}</h1>
        <p>{{ $meta->description ?? 'Daftar harga jasa pembuatan website, paket SEO, dan integrasi AI secara transparan.' }}</p>
    </div>

    <!-- ============================================================ -->
    <!-- TABEL HARGA -->
    <!-- ============================================================ -->
    @if($prices->count() > 0)
        <table class="price-table">
            <thead>
                <tr>
                    <th style="width:6%;">No</th>
                    <th style="width:10%;">Foto</th>
                    <th style="width:28%;">Armada / Produk</th>
                    <th style="width:20%;">Harga</th>
                    <th style="width:20%;">Keterangan</th>
                    <th style="width:16%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prices as $index => $price)
                    @php
                        // Gambar produk – base64 dari absolute path
                        $imgBase64 = null;
                        if ($price->produk && $price->produk->image_produk) {
                            $imgPath = '/home/azolatek/public_html/img/product/' . $price->produk->image_produk;
                            if (file_exists($imgPath)) {
                                $imgData = file_get_contents($imgPath);
                                $mime = mime_content_type($imgPath) ?: 'image/jpeg';
                                $imgBase64 = 'data:' . $mime . ';base64,' . base64_encode($imgData);
                            }
                        }
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($imgBase64)
                                <img src="{{ $imgBase64 }}" class="product-img" alt="{{ $price->produk->nama_produk ?? '' }}">
                            @else
                                <span style="color:#bbb;">-</span>
                            @endif
                        </td>
                        <td>{{ $price->produk->nama_produk ?? '-' }}</td>
                        <td class="harga">Rp {{ number_format($price->harga, 0, ',', '.') }}</td>
                        <td>{{ $price->produk->short_desc ?? '-' }}</td>
                        <td><span class="badge">Detail</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align:center; color:#999; padding:20px 0;">Belum ada data harga.</p>
    @endif

    <!-- ============================================================ -->
    <!-- FOOTER -->
    <!-- ============================================================ -->
    <div class="footer">
        <p>Hubungi Kami segera untuk solusi kebutuhan bisnis Anda. Harga bisa dibicarakan dan Kami juga terima perbaikan project gagal dari orang lain.</p>
        <p>* Harga dapat berubah sewaktu-waktu tanpa pemberitahuan.</p>
    </div>

</div>
</body>
</html>