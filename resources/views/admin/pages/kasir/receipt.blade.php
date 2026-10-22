<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk {{ $transaction->code }} - {{ config('app.name') }}</title>

    <style>
        /* ============================================
           RESET & LAYOUT STRUK
        ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        /* ============================================
           STRUK — 80mm THERMAL PRINTER SIZE
        ============================================ */
        .receipt {
            width: 80mm;                    /* lebar struk standar 80mm */
            max-width: 100%;
            background: white;
            padding: 12px 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* ============================================
           HEADER
        ============================================ */
        .receipt-header {
            text-align: center;
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
        }

        .receipt-store-name {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .receipt-store-addr {
            font-size: 10.5px;
            line-height: 1.3;
        }

        .receipt-store-phone {
            font-size: 10.5px;
            margin-top: 2px;
        }

        /* ============================================
           INFO TRANSAKSI
        ============================================ */
        .receipt-info {
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
            font-size: 11px;
        }

        .receipt-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .receipt-info-row span:first-child {
            color: #333;
        }

        .receipt-info-row span:last-child {
            font-weight: 600;
            text-align: right;
        }

        /* ============================================
           ITEMS
        ============================================ */
        .receipt-items {
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
        }

        .receipt-item {
            margin-bottom: 6px;
        }

        .receipt-item-name {
            font-weight: 600;
            font-size: 11.5px;
            margin-bottom: 2px;
            word-break: break-word;
        }

        .receipt-item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            padding-left: 6px;
        }

        .receipt-item-qty {
            color: #333;
        }

        .receipt-item-subtotal {
            font-weight: 600;
            text-align: right;
        }

        /* ============================================
           SUMMARY
        ============================================ */
        .receipt-summary {
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
            font-size: 11.5px;
        }

        .receipt-summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .receipt-summary-row--total {
            font-size: 13px;
            font-weight: 700;
            padding-top: 6px;
            margin-top: 6px;
            border-top: 1px solid #000;
        }

        .receipt-summary-row--total span:last-child {
            font-size: 14px;
        }

        /* ============================================
           PAYMENT
        ============================================ */
        .receipt-payment {
            padding-bottom: 8px;
            border-bottom: 1px dashed #000;
            margin-bottom: 8px;
            font-size: 11.5px;
        }

        .receipt-payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .receipt-payment-row--change {
            font-size: 13px;
            font-weight: 700;
            padding-top: 4px;
            border-top: 1px dotted #666;
            margin-top: 4px;
        }

        /* ============================================
           FOOTER
        ============================================ */
        .receipt-footer {
            text-align: center;
            font-size: 10.5px;
            line-height: 1.5;
            margin-top: 8px;
        }

        .receipt-footer-thanks {
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .receipt-footer-note {
            color: #333;
        }

        .receipt-barcode {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            font-family: 'Courier New', monospace;
        }

        /* ============================================
           TOMBOL AKSI (TIDAK TERCETAK)
        ============================================ */
        .receipt-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-primary {
            background: #0aad0a;
            color: white;
        }

        .btn-primary:hover {
            background: #088a08;
        }

        .btn-outline {
            background: white;
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .btn-outline:hover {
            background: #f9fafb;
        }

        /* ============================================
           PRINT STYLE — HILANGKAN TOMBOL, FULL PAGE
        ============================================ */
        @media print {
            @page {
                size: 80mm auto;              /* lebar 80mm, tinggi otomatis */
                margin: 0;
            }

            body {
                background: white;
                padding: 0;
                display: block;
            }

            .receipt {
                width: 100%;
                box-shadow: none;
                padding: 8px;
            }

            .receipt-actions {
                display: none !important;      /* sembunyikan tombol saat print */
            }
        }
    </style>
</head>
<body>

    {{-- Tombol Aksi (tidak muncul saat print) --}}
    <div class="receipt-actions">
        <button type="button" class="btn btn-primary" onclick="window.print()">
            🖨️ Cetak Struk
        </button>
        <a href="{{ route('admin.transaksi.pdf', $transaction) }}" class="btn btn-primary">
            <i class="ti ti-file-download"></i> Download Invoice PDF
        </a>
        <a href="{{ route('admin.kasir.index') }}" class="btn btn-outline">
            ← Kasir Lagi
        </a>
    </div>

    {{-- STRUK --}}
    <div class="receipt">

        {{-- HEADER --}}
        <div class="receipt-header">
            <div class="receipt-store-name">TOKO RETAIL MAKMUR</div>
            <div class="receipt-store-addr">Jl. Contoh No. 123, Jakarta</div>
            <div class="receipt-store-phone">Telp: 021-1234567</div>
        </div>

        {{-- INFO TRANSAKSI --}}
        <div class="receipt-info">
            <div class="receipt-info-row">
                <span>No. Transaksi</span>
                <span>{{ $transaction->code }}</span>
            </div>
            <div class="receipt-info-row">
                <span>Tanggal</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="receipt-info-row">
                <span>Kasir</span>
                <span>{{ $transaction->user->name ?? 'Admin' }}</span>
            </div>
            <div class="receipt-info-row">
                <span>Pelanggan</span>
                <span>{{ $transaction->customer_name }}</span>
            </div>
            @if($transaction->customer_phone)
                <div class="receipt-info-row">
                    <span>No. HP</span>
                    <span>{{ $transaction->customer_phone }}</span>
                </div>
            @endif
        </div>

        {{-- ITEMS --}}
        <div class="receipt-items">
            @foreach($transaction->items as $item)
                <div class="receipt-item">
                    <div class="receipt-item-name">{{ $item->product_name }}</div>
                    <div class="receipt-item-detail">
                        <span class="receipt-item-qty">
                            {{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                        </span>
                        <span class="receipt-item-subtotal">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- SUMMARY --}}
        <div class="receipt-summary">
            <div class="receipt-summary-row">
                <span>Subtotal</span>
                <span>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
            </div>

            @if($transaction->discount_amount > 0)
                <div class="receipt-summary-row">
                    <span>Diskon ({{ number_format($transaction->discount_percent, 0) }}%)</span>
                    <span>- Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</span>
                </div>
            @endif

            @if($transaction->tax_amount > 0)
                <div class="receipt-summary-row">
                    <span>Pajak</span>
                    <span>Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</span>
                </div>
            @endif

            @if($transaction->other_fee > 0)
                <div class="receipt-summary-row">
                    <span>Biaya Lain</span>
                    <span>Rp {{ number_format($transaction->other_fee, 0, ',', '.') }}</span>
                </div>
            @endif

            <div class="receipt-summary-row receipt-summary-row--total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- PAYMENT --}}
        <div class="receipt-payment">
            <div class="receipt-payment-row">
                <span>Metode</span>
                <span>{{ strtoupper($transaction->payment_method) }}</span>
            </div>
            <div class="receipt-payment-row">
                <span>Bayar</span>
                <span>Rp {{ number_format($transaction->paid, 0, ',', '.') }}</span>
            </div>
            <div class="receipt-payment-row receipt-payment-row--change">
                <span>Kembalian</span>
                <span>Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="receipt-footer">
            <div class="receipt-footer-thanks">*** TERIMA KASIH ***</div>
            <div class="receipt-footer-note">Barang yang sudah dibeli</div>
            <div class="receipt-footer-note">tidak dapat dikembalikan</div>

            <div class="receipt-barcode">{{ $transaction->code }}</div>

            <div class="receipt-footer-note" style="margin-top: 8px; font-size: 10px;">
                {{ now()->format('d/m/Y H:i:s') }}
            </div>
        </div>

    </div>

    <script>
        // Auto open print dialog saat halaman dibuka (opsional)
        // Uncomment kalau mau auto-print
        // window.addEventListener('load', function() {
        //     setTimeout(() => window.print(), 500);
        // });
    </script>

</body>
</html>
