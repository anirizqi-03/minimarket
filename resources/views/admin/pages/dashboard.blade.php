@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

@if(session('success'))
        <div class="flash-alert flash-alert--success" id="flashAlert">
            <div class="flash-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12l5 5L20 7"/>
                </svg>
            </div>
            <div class="flash-alert-text">{{ session('success') }}</div>
            <button type="button" class="flash-alert-close" onclick="document.getElementById('flashAlert').remove()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="flash-alert flash-alert--error" id="flashAlert">
            <div class="flash-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
            </div>
            <div class="flash-alert-text">{{ session('error') }}</div>
            <button type="button" class="flash-alert-close" onclick="document.getElementById('flashAlert').remove()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif


{{-- ============ PAGE HEADER ============ --}}
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-sub">Ringkasan aktivitas minimarket — {{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-calendar"></i> Bulan Ini</button>
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <button class="btn btn-primary"><i class="ti ti-plus"></i> Transaksi Baru</button>
    </div>
</div>

{{-- ============ STAT CARDS ============ --}}
<div class="stat-grid">

    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-currency-dollar"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Penjualan</p>
            <div class="stat-value">Rp 45.250.000</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> +12,5%</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-users"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Customer</p>
            <div class="stat-value">1.245</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> +8,2%</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--orange"><i class="ti ti-wallet"></i></div>
        <div class="stat-info">
            <p class="stat-label">Saldo Kas</p>
            <div class="stat-value">Rp 12.850.000</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> +5,1%</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-package"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Produk</p>
            <div class="stat-value">568 <span class="unit">item</span></div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> +3,7%</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--indigo"><i class="ti ti-category"></i></div>
        <div class="stat-info">
            <p class="stat-label">Kategori Produk</p>
            <div class="stat-value">12 <span class="unit">kategori</span></div>
            <span class="stat-trend up"><i class="ti ti-check"></i> Aktif semua</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--teal"><i class="ti ti-truck"></i></div>
        <div class="stat-info">
            <p class="stat-label">Supplier Aktif</p>
            <div class="stat-value">8 <span class="unit">supplier</span></div>
            <span class="stat-trend up"><i class="ti ti-check"></i> Terverifikasi</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--yellow"><i class="ti ti-receipt"></i></div>
        <div class="stat-info">
            <p class="stat-label">Transaksi Hari Ini</p>
            <div class="stat-value">47</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> +9,3%</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--red"><i class="ti ti-alert-triangle"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Menipis</p>
            <div class="stat-value">14 <span class="unit">produk</span></div>
            <span class="stat-trend down"><i class="ti ti-alert-circle"></i> Perlu restock</span>
        </div>
    </div>

</div>

{{-- ============ CHART ROW ============ --}}
<div class="grid-2">

    {{-- Grafik Penjualan --}}
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Statistik Penjualan</h3>
                <p class="card-sub">Pendapatan per bulan tahun {{ date('Y') }}</p>
            </div>
            <select class="form-control" style="width: 120px; padding: 6px 10px; font-size: 12.5px;">
                <option>{{ date('Y') }}</option>
                <option>{{ date('Y') - 1 }}</option>
                <option>{{ date('Y') - 2 }}</option>
            </select>
        </div>
        <div class="card-body">
            <div class="chart-wrap">
                <canvas id="chartPenjualan"></canvas>
            </div>
        </div>
    </div>

    {{-- Grafik Kategori --}}
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Kategori Produk</h3>
                <p class="card-sub">Distribusi per kategori</p>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-wrap sm">
                <canvas id="chartKategori"></canvas>
            </div>
            <div style="margin-top: 14px; display: flex; flex-direction: column; gap: 8px;">
                <div class="flex items-center justify-between" style="font-size: 12.5px;">
                    <span><span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#0aad0a; margin-right:6px;"></span>Makanan</span>
                    <strong>35%</strong>
                </div>
                <div class="flex items-center justify-between" style="font-size: 12.5px;">
                    <span><span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#0284c7; margin-right:6px;"></span>Minuman</span>
                    <strong>25%</strong>
                </div>
                <div class="flex items-center justify-between" style="font-size: 12.5px;">
                    <span><span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#d97706; margin-right:6px;"></span>Snack</span>
                    <strong>20%</strong>
                </div>
                <div class="flex items-center justify-between" style="font-size: 12.5px;">
                    <span><span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:#7c3aed; margin-right:6px;"></span>Kebutuhan Rumah</span>
                    <strong>20%</strong>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ============ RIWAYAT TRANSAKSI & TOP PRODUK ============ --}}
<div class="grid-2">

    {{-- Riwayat Transaksi --}}
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Riwayat Transaksi Terbaru</h3>
                <p class="card-sub">5 transaksi terakhir</p>
            </div>
            <a href="#" style="font-size: 12.5px; color: var(--primary); font-weight: 600;">Lihat Semua →</a>
        </div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>TRX-001</strong></td>
                        <td>Ahmad Fauzi</td>
                        <td class="text-right"><strong>Rp 250.000</strong></td>
                        <td class="text-center"><span class="badge badge--success">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>TRX-002</strong></td>
                        <td>Siti Nurhaliza</td>
                        <td class="text-right"><strong>Rp 180.000</strong></td>
                        <td class="text-center"><span class="badge badge--success">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>TRX-003</strong></td>
                        <td>Budi Santoso</td>
                        <td class="text-right"><strong>Rp 320.000</strong></td>
                        <td class="text-center"><span class="badge badge--warning">Pending</span></td>
                    </tr>
                    <tr>
                        <td><strong>TRX-004</strong></td>
                        <td>Dewi Lestari</td>
                        <td class="text-right"><strong>Rp 95.000</strong></td>
                        <td class="text-center"><span class="badge badge--success">Selesai</span></td>
                    </tr>
                    <tr>
                        <td><strong>TRX-005</strong></td>
                        <td>Rizki Pratama</td>
                        <td class="text-right"><strong>Rp 410.000</strong></td>
                        <td class="text-center"><span class="badge badge--success">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Top Produk --}}
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Produk Terlaris</h3>
                <p class="card-sub">Bulan ini</p>
            </div>
            <a href="#" style="font-size: 12.5px; color: var(--primary); font-weight: 600;">Lihat Semua →</a>
        </div>
        <div class="card-body" style="display: flex; flex-direction: column; gap: 14px;">
            @php
                $tops = [
                    ['no' => 1, 'nama' => 'Beras Premium 5kg', 'kat' => 'Makanan', 'terjual' => 245, 'harga' => 75000],
                    ['no' => 2, 'nama' => 'Minyak Goreng 2L', 'kat' => 'Makanan', 'terjual' => 198, 'harga' => 38000],
                    ['no' => 3, 'nama' => 'Teh Kotak 1L', 'kat' => 'Minuman', 'terjual' => 176, 'harga' => 12000],
                    ['no' => 4, 'nama' => 'Biskuit Cokelat', 'kat' => 'Snack', 'terjual' => 152, 'harga' => 15000],
                    ['no' => 5, 'nama' => 'Sabun Mandi', 'kat' => 'Kebutuhan Rumah', 'terjual' => 134, 'harga' => 8500],
                ];
            @endphp
            @foreach($tops as $t)
                <div class="flex items-center gap-3">
                    <div style="width: 30px; height: 30px; border-radius: 8px; background: var(--surface-3); display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--text-3); font-size: 13px; flex-shrink: 0;">
                        {{ $t['no'] }}
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size: 13.5px; font-weight: 600; color: var(--text);" class="text-truncate">{{ $t['nama'] }}</div>
                        <div style="font-size: 11.5px; color: var(--text-3);">{{ $t['kat'] }}</div>
                    </div>
                    <div class="text-right">
                        <div style="font-size: 13px; font-weight: 700; color: var(--text);">{{ $t['terjual'] }} pcs</div>
                        <div style="font-size: 11.5px; color: var(--text-3);">Rp {{ number_format($t['harga'], 0, ',', '.') }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

{{-- ============ RINGKASAN MASTER DATA ============ --}}
<div class="grid-2-even">

    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Ringkasan Kategori</h3>
                <p class="card-sub">Top 5 kategori berdasarkan produk</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Makanan</strong></td>
                        <td class="text-center">145</td>
                        <td class="text-center"><span class="badge badge--success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Minuman</strong></td>
                        <td class="text-center">98</td>
                        <td class="text-center"><span class="badge badge--success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Snack</strong></td>
                        <td class="text-center">87</td>
                        <td class="text-center"><span class="badge badge--success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Kebutuhan Rumah</strong></td>
                        <td class="text-center">120</td>
                        <td class="text-center"><span class="badge badge--success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td><strong>Perawatan Diri</strong></td>
                        <td class="text-center">65</td>
                        <td class="text-center"><span class="badge badge--success">Aktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Ringkasan Customer</h3>
                <p class="card-sub">Customer paling aktif</p>
            </div>
        </div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th class="text-center">Transaksi</th>
                        <th class="text-right">Total Belanja</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar--green avatar-sm">AF</div>
                                <strong>Ahmad Fauzi</strong>
                            </div>
                        </td>
                        <td class="text-center">25</td>
                        <td class="text-right"><strong>Rp 3.500.000</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar--blue avatar-sm">SN</div>
                                <strong>Siti Nurhaliza</strong>
                            </div>
                        </td>
                        <td class="text-center">18</td>
                        <td class="text-right"><strong>Rp 2.100.000</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar--purple avatar-sm">BS</div>
                                <strong>Budi Santoso</strong>
                            </div>
                        </td>
                        <td class="text-center">12</td>
                        <td class="text-right"><strong>Rp 1.800.000</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar--orange avatar-sm">DL</div>
                                <strong>Dewi Lestari</strong>
                            </div>
                        </td>
                        <td class="text-center">8</td>
                        <td class="text-right"><strong>Rp 950.000</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar--teal avatar-sm">RP</div>
                                <strong>Rizki Pratama</strong>
                            </div>
                        </td>
                        <td class="text-center">15</td>
                        <td class="text-right"><strong>Rp 2.400.000</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.color = '#6b7280';

        // ============ PENJUALAN ============
        const ctx1 = document.getElementById('chartPenjualan');
        if (ctx1) {
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                    datasets: [{
                        label: 'Penjualan',
                        data: [3200000, 4100000, 3800000, 5200000, 4800000, 5500000, 6100000, 5800000, 4900000, 6300000, 7200000, 8100000],
                        borderColor: '#0aad0a',
                        backgroundColor: 'rgba(10, 173, 10, 0.08)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#0aad0a',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function (ctx) {
                                    return 'Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' },
                            ticks: {
                                callback: function (v) { return 'Rp ' + (v/1000000) + 'jt'; }
                            }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // ============ KATEGORI ============
        const ctx2 = document.getElementById('chartKategori');
        if (ctx2) {
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Makanan', 'Minuman', 'Snack', 'Kebutuhan Rumah'],
                    datasets: [{
                        data: [35, 25, 20, 20],
                        backgroundColor: ['#0aad0a', '#0284c7', '#d97706', '#7c3aed'],
                        borderWidth: 0,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function (ctx) { return ctx.label + ': ' + ctx.parsed + '%'; }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
