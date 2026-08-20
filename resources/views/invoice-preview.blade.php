<!DOCTYPE html>
<html>
<head>
  <style>
    @page { margin: 30px; } /* biar ada jarak tepi */
    body { 
      font-family: Helvetica, Arial, sans-serif;
      font-size: 12px; 
      color: #333; 
    }
    h2 { 
      text-align: center; 
      margin-bottom: 20px; 
      font-size: 20px;
      color: #222;
      letter-spacing: 1px;
    }
    .header { 
      display: flex; 
      justify-content: space-between; 
      margin-bottom: 20px; 
    }
    .header div { width: 45%; }
    .header strong { color: #111; }

    table { 
      width: 100%; 
      border-collapse: collapse; 
      margin-top: 20px; 
    }
    th { 
      background: #f2f2f2; 
      font-weight: bold; 
      text-align: center; 
      font-size: 13px;
    }
    th, td { 
      border: 1px solid #aaa; 
      padding: 8px; 
    }
    td { font-size: 12px; }

    tfoot td { 
      font-weight: bold; 
      background: #fafafa; 
    }

    .thanks { 
      margin-top: 40px; 
      font-style: italic; 
      text-align: center; 
      font-size: 13px;
      color: #555;
    }
  </style>
  <style>
  body {
    background: #ccc; /* abu biar kelihatan beda */
    padding: 20px;
  }

  .page {
    background: #fff;
    width: 210mm;   /* ukuran A4 */
    min-height: 297mm;
    margin: auto;
    padding: 20mm;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
  }

  @media print {
    body {
      background: none;
      padding: 0;
    }
    .page {
      margin: 0;
      box-shadow: none;
      width: auto;
      min-height: auto;
      padding: 0;
    }
  }
</style>
</head>
@php
    // Pecah baris alamat penjual
    $fromLines = explode("\n", $data['from']);
    $sellerName = $fromLines[0] ?? '';
    $sellerAddress = implode("<br>", array_slice($fromLines, 1));
@endphp

<body>
     <div class="page">
  {{-- HEADER --}}
  <table width="100%" cellspacing="0" cellpadding="0" 
       style="border-collapse:collapse; margin-bottom:20px; border-bottom:2px solid #000;">
    <tr>
      {{-- LOGO di kiri --}}
      <td width="15%" align="center" valign="middle" style="border:0;">
        @if(!empty($data['logo_path']))
          @if(app()->runningInConsole())
            <img src="file://{{ $data['logo_path'] }}" height="70">
          @else
            <img src="{{ $data['logo_url'] }}" height="70">
          @endif
        @endif
      </td>

      {{-- JUDUL di tengah --}}
      <td width="70%" align="center" valign="middle" style="border:0;">
        <p style="font-size: 1.2rem; text-transform: uppercase; margin:0; line-height:1.2;">
            <strong>{!! $sellerName !!}</strong>
        </p>
        <div style="margin:0; padding:0; line-height:1.2;">
            {!! $sellerAddress !!}
        </div>
    </td>

      {{-- Alamat (tanpa nama) di kanan --}}
      <td width="17%" align="right" valign="middle" style="font-size:11px; color:#555;border:0;">
       
      </td>
    </tr>
  </table>

  <h2>INVOICE</h2>

  <div class="header">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" style="margin-bottom:20px; border:0;">
      <tr>
        <td width="50%" valign="top" style="border:0;">
          <strong>Dari:</strong><br>
          {!! nl2br(e($data['from'])) !!}
        </td>
        <td width="50%" valign="top" style="border:0;">
          <strong>Kepada:</strong><br>
          {!! nl2br(e($data['to'])) !!}
        </td>
      </tr>
    </table>
  </div>

  <p>
    <strong>No Invoice:</strong> {{ $data['invoice_no'] }}<br>
    <strong>Tanggal:</strong> {{ $data['date'] }}<br>
    @if(!empty($data['due_date']))
      <strong>Jatuh Tempo:</strong> {{ $data['due_date'] }}
    @endif
  </p>

  <table>
    <thead>
      <tr>
        <th>Deskripsi</th>
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
        <td colspan="4" style="text-align:right"><strong>Total</strong></td>
        <td style="text-align:right"><strong>{{ number_format($total, 2) }}</strong></td>
      </tr>
    </tfoot>
  </table>
  

  <p class="thanks">Terima kasih atas kepercayaan Anda!</p>

  <hr style="margin:30px 0;">

  <p style="text-align:center; font-size:11px; color:#888;">
    Invoice ini dibuat otomatis menggunakan <strong>Invoice Generator AzolaTekno</strong>.<br>
    Solusi digital untuk UMKM & bisnis modern. 
    <a href="https://azolatekno.com" target="_blank" style="color:#444; text-decoration:none;">www.azolatekno.com</a>
  </p>
  </div>
</body>
</html>