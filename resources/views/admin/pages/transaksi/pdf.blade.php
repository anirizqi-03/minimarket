<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $transaction->code }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0aad0a; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #0aad0a; }
        .info { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f8fafc; }
        .text-right { text-align: right; }
        .total { font-weight: bold; text-align: right; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>MINIMARKET FRESHCART</h2>
        <p>Jl. Contoh No. 123, Jakarta<br>Telp: 021-1234567</p>
    </div>

    <div class="info">
        <table width="100%">
            <tr>
                <td>
                    <strong>Kepada:</strong><br>
                    {{ $transaction->customer_name }}<br>
                    {{ $transaction->customer_phone ?? '-' }}
                </td>
                <td class="text-right">
                    <strong>No. Invoice:</strong> {{ $transaction->code }}<br>
                    <strong>Tanggal:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}<br>
                    <strong>Kasir:</strong> {{ $transaction->user->name ?? 'Admin' }}
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-right">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->qty }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table width="100%">
        <tr>
            <td width="60%"></td>
            <td width="40%">
                <table width="100%">
                    <tr>
                        <td>Subtotal:</td>
                        <td class="text-right">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @if($transaction->discount_amount > 0)
                    <tr>
                        <td>Diskon:</td>
                        <td class="text-right">- Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    @if($transaction->tax_amount > 0)
                    <tr>
                        <td>Pajak:</td>
                        <td class="text-right">Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="total">TOTAL:</td>
                        <td class="total">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="margin-top: 40px; text-align: center; font-size: 10px; color: #777;">
        Terima kasih telah berbelanja!
    </div>
</body>
</html>
