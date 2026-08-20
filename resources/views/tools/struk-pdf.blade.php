<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body{font-family:monospace;font-size:10px;margin:0;padding:0}
    h2{text-align:center;margin:0;font-size:12px}
    p,table{margin:0 auto;width:100%;text-align:left}
    table{border-collapse:collapse;margin-top:5px}
    td{padding:2px 0}
    .center{text-align:center}
    .line{border-top:1px dashed #000;margin:4px 0}
  </style>
</head>
<body>
  <h2>{{ $data['store_name'] }}</h2>
  <p class="center">{{ $data['store_address'] }}</p>
  <div class="line"></div>

  <table>
    @foreach($data['items'] as $item)
      <tr>
        <td>{{ $item['name'] }} x{{ $item['qty'] }}</td>
        <td style="text-align:right">Rp{{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</td>
      </tr>
    @endforeach
  </table>

  <div class="line"></div>
  <table>
    <tr>
      <td>Subtotal</td>
      <td style="text-align:right">
        Rp{{ number_format($subtotal, 0, ',', '.') }}
      </td>
    </tr>

    @if($use_ppn)
  <tr>
    <td>PPN ({{ $ppn_value }}%)</td>
    <td style="text-align:right">Rp{{ number_format($ppn_amount, 0, ',', '.') }}</td>
  </tr>
@endif

    <tr>
      <td><strong>Total</strong></td>
      <td style="text-align:right"><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
    </tr>
  </table>

  <div class="line"></div>
  <p class="center">Terima kasih atas pembelian Anda!</p>
</body>
</html>