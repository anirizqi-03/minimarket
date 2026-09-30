@extends('admin.layouts.app')

@section('title', 'Kasir')

@section('content')


<div class="page-header">
    <div>
        <h1 class="page-title">Kasir</h1>
        <p class="page-sub">Transaksi penjualan minimarket</p>
    </div>
    <div class="page-actions">
        <a href="#" class="btn btn-outline">
            <i class="ti ti-history"></i> Riwayat Hari Ini
        </a>
    </div>
</div>


<div class="pos-wrapper">


    <div class="pos-left">

        {{-- INFO TOKO --}}
        <div class="pos-store-info">
            <div>
                <h3 class="pos-store-name">TOKO SUMBER BERKAH</h3>
                <p class="pos-store-addr">Jl. IMAM BONJOL NO.3</p>
            </div>
            <div style="text-align: right;">
                <p class="pos-trx-code" id="trxCode">TRX-{{ now()->format('Ymd') }}-001</p>
                <p class="pos-trx-date">{{ now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        {{-- TAMBAH BARANG --}}
        <div class="pos-section">
            <div class="pos-section-head">
                <span class="pos-section-title">Tambah Barang</span>
                <span class="pos-hint">[F2] Cari</span>
            </div>

            <div class="pos-search-wrap">
                <input type="text"
                       id="searchProduct"
                       class="pos-search-input"
                       placeholder="Cari / barcode..."
                       autocomplete="off"
                       autofocus />

                <div class="pos-search-results" id="searchResults"></div>
            </div>

            {{-- PELANGGAN --}}
            <div class="pos-row">
                <div class="pos-field">
                    <label class="pos-label">Pelanggan</label>
                    <input type="text"
                           id="customerName"
                           class="pos-input"
                           value="Umum"
                           placeholder="Nama pelanggan" />
                </div>
                <div class="pos-field">
                    <label class="pos-label">No Member / HP</label>
                    <input type="text"
                           id="customerPhone"
                           class="pos-input"
                           placeholder="Opsional" />
                </div>
            </div>
        </div>

        {{-- KERANJANG BELANJA --}}
        <div class="pos-section pos-cart-section">
            <div class="pos-section-head">
                <span class="pos-section-title">Keranjang Belanja</span>
                <span class="pos-hint" id="cartCount">0 item</span>
            </div>

            <div class="pos-cart-table-wrap">
                <table class="pos-cart-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Barang</th>
                            <th style="width: 90px; text-align: right;">Harga</th>
                            <th style="width: 70px; text-align: center;">Qty</th>
                            <th style="width: 100px; text-align: right;">Subtotal</th>
                            <th style="width: 40px;"></th>
                        </tr>
                    </thead>
                    <tbody id="cartBody">
                        <tr class="pos-cart-empty">
                            <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                                <div style="font-size: 32px; margin-bottom: 8px;">🛒</div>
                                Keranjang masih kosong
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

   
    <div class="pos-right">

        {{-- RINGKASAN --}}
        <div class="pos-section">
            <div class="pos-section-head">
                <span class="pos-section-title">Ringkasan Pembayaran</span>
            </div>

            <div class="pos-summary">
                <div class="pos-summary-row">
                    <span>Total Item</span>
                    <strong id="sumTotalItems">0</strong>
                </div>
                <div class="pos-summary-row">
                    <span>Subtotal</span>
                    <strong id="sumSubtotal">Rp 0</strong>
                </div>

                {{-- Diskon --}}
                <div class="pos-summary-row pos-summary-row--input">
                    <span>Diskon (%)</span>
                    <div class="pos-input-inline">
                        <input type="number"
                               id="discountPercent"
                               class="pos-input pos-input--sm"
                               value="0"
                               min="0"
                               max="100"
                               step="1" />
                        <span class="pos-input-suffix">%</span>
                    </div>
                </div>

                <div class="pos-summary-row">
                    <span>Diskon (Rp)</span>
                    <strong id="sumDiscount">Rp 0</strong>
                </div>

                {{-- Pajak --}}
                <div class="pos-summary-row pos-summary-row--input">
                    <span>Pajak</span>
                    <input type="number"
                           id="taxAmount"
                           class="pos-input pos-input--sm"
                           value="0"
                           min="0"
                           step="100" />
                </div>

                {{-- Biaya Lain --}}
                <div class="pos-summary-row pos-summary-row--input">
                    <span>Biaya Lain</span>
                    <input type="number"
                           id="otherFee"
                           class="pos-input pos-input--sm"
                           value="0"
                           min="0"
                           step="100" />
                </div>

                <div class="pos-summary-row pos-summary-row--total">
                    <span>TOTAL AKHIR</span>
                    <strong id="sumTotal">Rp 0</strong>
                </div>

                {{-- Uang Dibayar --}}
                <div class="pos-summary-label">Uang Dibayar</div>
                <input type="number"
                       id="paidAmount"
                       class="pos-input pos-input--lg"
                       value="0"
                       min="0"
                       step="500"
                       placeholder="Rp 0" />

                {{-- Payment Method --}}
                <div class="pos-payment-methods">
                    <button type="button" class="pos-pay-btn active" data-method="tunai">Tunai</button>
                    <button type="button" class="pos-pay-btn" data-method="qris">QRIS</button>
                    <button type="button" class="pos-pay-btn" data-method="debit">Debit</button>
                </div>

                {{-- Kembalian --}}
                <div class="pos-summary-label">Kembalian</div>
                <div class="pos-change" id="sumChange">Rp 0</div>

                {{-- Actions --}}
                <div class="pos-actions">
                    <button type="button" class="pos-btn pos-btn--ghost1" onclick="holdTransaction()">
                        [ Tahan ]
                    </button>
                    <button type="button" class="pos-btn pos-btn--ghost2" onclick="cancelTransaction()">
                        [ Batal ]
                    </button>
                </div>

                <button type="button" class="pos-btn pos-btn--primary" onclick="submitTransaction()">
                    <i class="ti ti-shopping-cart-check"></i>
                    BAYAR & CETAK
                </button>
            </div>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

let cart = [];
let paymentMethod = 'tunai';


const searchInput = document.getElementById('searchProduct');
const searchResults = document.getElementById('searchResults');
let searchTimeout = null;

searchInput.addEventListener('input', function () {
    clearTimeout(searchTimeout);
    const q = this.value.trim();

    if (q.length < 2) {
        searchResults.classList.remove('show');
        searchResults.innerHTML = '';
        return;
    }

    searchTimeout = setTimeout(() => {
        fetch(`{{ route('admin.kasir.search') }}?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => renderSearchResults(data))
            .catch(err => console.error(err));
    }, 250);
});

function renderSearchResults(products) {
    if (!products.length) {
        searchResults.innerHTML = '<div class="pos-search-empty">Produk tidak ditemukan</div>';
        searchResults.classList.add('show');
        return;
    }

    searchResults.innerHTML = products.map(p => `
        <div class="pos-search-item" onclick='addToCart(${JSON.stringify(p)})'>
            <div>
                <div class="pos-search-name">${p.name}</div>
                <div class="pos-search-meta">${p.category ?? '-'} · Stok: ${p.stock}</div>
            </div>
            <div class="pos-search-price">Rp ${formatNumber(p.price)}</div>
        </div>
    `).join('');

    searchResults.classList.add('show');
}

// Tutup hasil search kalau klik di luar
document.addEventListener('click', function (e) {
    if (!e.target.closest('.pos-search-wrap')) {
        searchResults.classList.remove('show');
    }
});


function addToCart(product) {
    const existing = cart.find(item => item.product_id === product.id);

    if (existing) {
        existing.qty++;
        existing.subtotal = existing.price * existing.qty;
    } else {
        cart.push({
            product_id: product.id,
            name:       product.name,
            price:      parseFloat(product.price),
            qty:        1,
            subtotal:   parseFloat(product.price),
        });
    }

    searchInput.value = '';
    searchResults.classList.remove('show');
    searchInput.focus();

    renderCart();
    calculateTotals();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    renderCart();
    calculateTotals();
}

function changeQty(index, delta) {
    cart[index].qty += delta;

    if (cart[index].qty <= 0) {
        removeFromCart(index);
        return;
    }

    cart[index].subtotal = cart[index].price * cart[index].qty;
    renderCart();
    calculateTotals();
}

function renderCart() {
    const tbody = document.getElementById('cartBody');
    const count = document.getElementById('cartCount');

    count.textContent = cart.length + ' item';

    if (!cart.length) {
        tbody.innerHTML = `
            <tr class="pos-cart-empty">
                <td colspan="6" style="text-align: center; padding: 40px; color: #9ca3af;">
                    <div style="font-size: 32px; margin-bottom: 8px;">🛒</div>
                    Keranjang masih kosong
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = cart.map((item, i) => `
        <tr>
            <td>${i + 1}</td>
            <td>
                <div class="pos-cart-name">${item.name}</div>
            </td>
            <td style="text-align: right;">${formatNumber(item.price)}</td>
            <td style="text-align: center;">
                <div class="pos-qty-ctrl">
                    <button type="button" onclick="changeQty(${i}, -1)">−</button>
                    <span>${item.qty}</span>
                    <button type="button" onclick="changeQty(${i}, 1)">+</button>
                </div>
            </td>
            <td style="text-align: right;"><strong>${formatNumber(item.subtotal)}</strong></td>
            <td style="text-align: center;">
                <button type="button" class="pos-remove-btn" onclick="removeFromCart(${i})" title="Hapus">
                    <i class="ti ti-x"></i>
                </button>
            </td>
        </tr>
    `).join('');
}


function calculateTotals() {
    let totalItems = 0;
    let subtotal = 0;

    cart.forEach(item => {
        totalItems += item.qty;
        subtotal += item.subtotal;
    });

    const discountPercent = parseFloat(document.getElementById('discountPercent').value) || 0;
    const discountAmount  = subtotal * (discountPercent / 100);
    const taxAmount       = parseFloat(document.getElementById('taxAmount').value) || 0;
    const otherFee        = parseFloat(document.getElementById('otherFee').value) || 0;
    const total           = subtotal - discountAmount + taxAmount + otherFee;

    const paid   = parseFloat(document.getElementById('paidAmount').value) || 0;
    const change = paid - total;

    document.getElementById('sumTotalItems').textContent = totalItems;
    document.getElementById('sumSubtotal').textContent   = 'Rp ' + formatNumber(subtotal);
    document.getElementById('sumDiscount').textContent   = 'Rp ' + formatNumber(discountAmount);
    document.getElementById('sumTotal').textContent      = 'Rp ' + formatNumber(total);
    document.getElementById('sumChange').textContent     = 'Rp ' + formatNumber(change >= 0 ? change : 0);

    // Highlight kembalian negatif
    document.getElementById('sumChange').style.color = change < 0 ? '#dc2626' : '#0aad0a';
}

// Trigger recalc on input changes
['discountPercent', 'taxAmount', 'otherFee', 'paidAmount'].forEach(id => {
    document.getElementById(id).addEventListener('input', calculateTotals);
});


document.querySelectorAll('.pos-pay-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.pos-pay-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        paymentMethod = this.dataset.method;
    });
});


function cancelTransaction() {
    if (!cart.length) return;

    if (confirm('Yakin ingin membatalkan transaksi ini?')) {
        cart = [];
        document.getElementById('customerName').value = 'Umum';
        document.getElementById('customerPhone').value = '';
        document.getElementById('discountPercent').value = 0;
        document.getElementById('taxAmount').value = 0;
        document.getElementById('otherFee').value = 0;
        document.getElementById('paidAmount').value = 0;

        renderCart();
        calculateTotals();
    }
}

function holdTransaction() {
    alert('Fitur "Tahan" akan diimplementasikan di versi berikutnya.');
}

function submitTransaction() {
    if (!cart.length) {
        alert('Keranjang masih kosong!');
        return;
    }


    const subtotal        = cart.reduce((sum, item) => sum + item.subtotal, 0);
    const discountPercent = parseFloat(document.getElementById('discountPercent').value) || 0;
    const discountAmount  = subtotal * (discountPercent / 100);
    const taxAmount       = parseFloat(document.getElementById('taxAmount').value) || 0;
    const otherFee        = parseFloat(document.getElementById('otherFee').value) || 0;
    const totalAkhir      = subtotal - discountAmount + taxAmount + otherFee;

    const paid   = parseFloat(document.getElementById('paidAmount').value) || 0;
    const change = paid - totalAkhir;

    // Validasi: pakai totalAkhir, BUKAN subtotal
    if (paid < totalAkhir) {
        alert('❌ Uang bayar kurang!\n\nTotal: Rp ' + formatNumber(totalAkhir) + '\nBayar: Rp ' + formatNumber(paid) + '\nKurang: Rp ' + formatNumber(totalAkhir - paid));
        return;
    }

    const payload = {
        _token: '{{ csrf_token() }}',
        customer_name:    document.getElementById('customerName').value,
        customer_phone:   document.getElementById('customerPhone').value,
        items:            cart,
        discount_percent: discountPercent,
        tax_amount:       taxAmount,
        other_fee:        otherFee,
        paid:             paid,
        payment_method:   paymentMethod,
    };

    // Disable button
    const btn = document.querySelector('.pos-btn--primary');
    btn.disabled = true;
    btn.innerHTML = '<i class="ti ti-loader"></i> Memproses...';

    fetch('{{ route('admin.kasir.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify(payload),
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Buka struk di tab baru
            const receiptUrl = `/admin/kasir/receipt/${data.transaction.id}`;
            window.open(receiptUrl, '_blank', 'width=400,height=650');

            // Reset form
            cart = [];
            document.getElementById('customerName').value = 'Umum';
            document.getElementById('customerPhone').value = '';
            document.getElementById('discountPercent').value = 0;
            document.getElementById('taxAmount').value = 0;
            document.getElementById('otherFee').value = 0;
            document.getElementById('paidAmount').value = 0;

            renderCart();
            calculateTotals();

            // Reload untuk update kode transaksi
            setTimeout(() => location.reload(), 1500);
        } else {
            alert('❌ ' + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('❌ Terjadi kesalahan: ' + err.message);
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-shopping-cart-check"></i> BAYAR & CETAK';
    });
}

function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(Math.round(num));
}


document.addEventListener('keydown', function (e) {
    // F2: fokus ke search
    if (e.key === 'F2') {
        e.preventDefault();
        searchInput.focus();
        searchInput.select();
    }

    // F9: submit
    if (e.key === 'F9') {
        e.preventDefault();
        submitTransaction();
    }

    // ESC: clear search
    if (e.key === 'Escape') {
        searchInput.value = '';
        searchResults.classList.remove('show');
    }
});

// Init
calculateTotals();
</script>
@endpush
