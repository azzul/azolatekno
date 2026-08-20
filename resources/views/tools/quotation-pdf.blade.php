<!DOCTYPE html>
<html>
<head>
  <style>
    @page { margin: 30px; }
    body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #333; }
    h2 { text-align: center; margin-bottom: 20px; font-size: 20px; color: #222; letter-spacing: 1px; }
    .header { display: flex; justify-content: space-between; margin-bottom: 20px; }
    .header div { width: 45%; }
    .header strong { color: #111; }

    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th { background: #f2f2f2; font-weight: bold; text-align: center; font-size: 13px; }
    th, td { border: 1px solid #aaa; padding: 8px; }
    td { font-size: 12px; }
    tfoot td { font-weight: bold; background: #fafafa; }

    .thanks { margin-top: 40px; font-style: italic; text-align: center; font-size: 13px; color: #555; }
  </style>
</head>

@php
    $fromLines = explode("\n", $data['from']);
    $companyName = $fromLines[0] ?? '';
    $companyAddress = implode("<br>", array_slice($fromLines, 1));
@endphp

<body>
  {{-- HEADER --}}
<div style="text-align:center; margin-bottom:20px; border-bottom:2px solid #000; padding-bottom:15px;">
    @if(!empty($logoBase64))
        <img src="{{ $logoBase64 }}" height="80" style="margin-bottom:10px;"><br>
    @endif
    <p style="font-size: 1.2rem; text-transform: uppercase; margin:0; line-height:1.3;">
        <strong>{!! $companyName !!}</strong>
    </p>
    <div style="margin:0; padding:0; line-height:1.3; font-size:11px;">
        {!! $companyAddress !!}
    </div>
</div>

  <h2>QUOTATION / SURAT PENAWARAN</h2>

  <div class="header">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:20px; border:0;">
      <tr>
        <td width="50%" valign="top" style="border:0;">
          <strong>Dari :</strong><br>
          {!! nl2br(e($data['from'])) !!}
        </td>
        <td width="50%" valign="top" style="border:0;">
          <strong>Kepada :</strong><br>
          {!! nl2br(e($data['to'])) !!}
        </td>
      </tr>
    </table>
  </div>

  <p>
    <strong>No Penawaran:</strong> {{ $data['quotation_no'] }}<br>
    <strong>Tanggal:</strong> {{ $data['date'] }}<br>
    @if(!empty($data['valid_until']))
      <strong>Berlaku Hingga:</strong> {{ $data['valid_until'] }}
    @endif
  </p>

  <table>
    <thead>
      <tr>
        <th>Deskripsi Produk / Jasa</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th>Harga/Unit</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data['items'] as $item)
        <tr>
          <td>{{ $item['desc'] }}</td>
          <td style="text-align:center">{{ $item['qty'] }}</td>
          <td style="text-align:center">{{ $item['unit'] ?? '-' }}</td>
          <td style="text-align:right">{{ number_format($item['unit_price'], 2) }}</td>
          <td style="text-align:right">{{ number_format($item['qty'] * $item['unit_price'], 2) }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4" style="text-align:right">Subtotal</td>
        <td style="text-align:right">{{ number_format($subtotal, 2) }}</td>
      </tr>
      @if(!empty($ppnValue) && $ppnValue > 0)
      <tr>
        <td colspan="4" style="text-align:right">PPN {{ $ppnRate }}%</td>
        <td style="text-align:right">{{ number_format($ppnValue, 2) }}</td>
      </tr>
      @endif
      <tr>
        <td colspan="4" style="text-align:right"><strong>Total Penawaran</strong></td>
        <td style="text-align:right"><strong>{{ number_format($total, 2) }}</strong></td>
      </tr>
    </tfoot>
  </table>

 <p class="thanks">
  Kami berharap penawaran ini dapat memenuhi kebutuhan Anda dan menjadi solusi yang tepat bagi bisnis maupun kebutuhan proyek Anda. 
  Jangan ragu untuk menghubungi kami apabila ada hal yang ingin didiskusikan lebih lanjut, baik terkait spesifikasi produk, penyesuaian harga, 
  maupun layanan tambahan yang dapat kami berikan. <br><br>
  Tim kami siap membantu dengan informasi yang lebih detail, agar tercipta kerja sama yang saling menguntungkan dan berkelanjutan. 
  Terima kasih atas kesempatan dan kepercayaan yang diberikan, semoga kita dapat segera merealisasikan kerja sama ini.
</p>

  <hr style="margin:30px 0;">

  <p style="text-align:center; font-size:11px; color:#888;">
    Dokumen ini dibuat otomatis menggunakan <strong>Quotation Generator AzolaTekno</strong>.<br>
    Solusi digital untuk UMKM & bisnis modern. 
    <a href="https://azolatekno.com" target="_blank" style="color:#444; text-decoration:none;">www.azolatekno.com</a>
  </p>
</body>
</html>