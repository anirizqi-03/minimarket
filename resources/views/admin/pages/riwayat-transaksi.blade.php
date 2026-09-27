@extends('admin.layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Transaksi</h1>
        <p class="page-sub">Semua transaksi penjualan minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export Excel</button>
        <button class="btn btn-primary" onclick="openModal('modalTransaksi')">
            <i class="ti ti-plus"></i> Transaksi Baru
        </button>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-receipt"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Transaksi</p>
            <div class="stat-value">1.458</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-currency-dollar"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Pendapatan</p>
            <div class="stat-value">Rp 63,2jt</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--teal"><i class="ti ti-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Selesai</p>
            <div class="stat-value">1.420</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--yellow"><i class="ti ti-clock"></i></div>
        <div class="stat-info">
            <p class="stat-label">Pending / Batal</p>
            <div class="stat-value">38</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Transaksi</h3>
            <p class="card-sub">Semua transaksi tercatat</p>
        </div>
    </div>

    <div class="filter-bar">
        <input type="text" class="form-control" placeholder="Cari ID / customer..." />
        <select class="form-control">
            <option>Semua Status</option>
            <option>Selesai</option>
            <option>Pending</option>
            <option>Batal</option>
        </select>
        <select class="form-control">
            <option>Semua Metode</option>
            <option>Cash</option>
            <option>Transfer</option>
            <option>QRIS</option>
        </select>
        <input type="date" class="form-control" />
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Customer</th>
                    <th class="text-right">Total</th>
                    <th class="text-center">Metode</th>
                    <th class="text-center">Status</th>
                    <th>Tanggal</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $trx = [
                        ['id' => 'TRX-20260926-001', 'customer' => 'Ahmad Fauzi', 'total' => 250000, 'metode' => 'Transfer', 'status' => 'Selesai', 'tanggal' => '26/09/2026 10:30'],
                        ['id' => 'TRX-20260926-002', 'customer' => 'Siti Nurhaliza', 'total' => 180000, 'metode' => 'Cash', 'status' => 'Selesai', 'tanggal' => '26/09/2026 11:15'],
                        ['id' => 'TRX-20260925-003', 'customer' => 'Budi Santoso', 'total' => 320000, 'metode' => 'Transfer', 'status' => 'Pending', 'tanggal' => '25/09/2026 14:20'],
                        ['id' => 'TRX-20260925-004', 'customer' => 'Dewi Lestari', 'total' => 95000, 'metode' => 'QRIS', 'status' => 'Selesai', 'tanggal' => '25/09/2026 16:45'],
                        ['id' => 'TRX-20260924-005', 'customer' => 'Rizki Pratama', 'total' => 410000, 'metode' => 'Transfer', 'status' => 'Selesai', 'tanggal' => '24/09/2026 09:10'],
                        ['id' => 'TRX-20260924-006', 'customer' => 'Anisa Rahmawati', 'total' => 125000, 'metode' => 'Cash', 'status' => 'Batal', 'tanggal' => '24/09/2026 13:30'],
                    ];
                    $badgeMap = ['Selesai' => 'success', 'Pending' => 'warning', 'Batal' => 'danger'];
                @endphp

                @foreach($trx as $t)
                    <tr>
                        <td><strong>{{ $t['id'] }}</strong></td>
                        <td>{{ $t['customer'] }}</td>
                        <td class="text-right"><strong>Rp {{ number_format($t['total'], 0, ',', '.') }}</strong></td>
                        <td class="text-center"><span class="badge badge--gray">{{ $t['metode'] }}</span></td>
                        <td class="text-center"><span class="badge badge--{{ $badgeMap[$t['status']] }}">{{ $t['status'] }}</span></td>
                        <td>{{ $t['tanggal'] }}</td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="btn btn-outline btn-sm btn-icon" title="Detail"><i class="ti ti-eye"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Invoice"><i class="ti ti-printer"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Hapus" onclick="openModal('modalHapus')" style="color: var(--red);"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-info">Menampilkan 1–6 dari 1.458 transaksi</span>
        <div class="pagination-controls">
            <button class="page-btn"><i class="ti ti-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">...</button>
            <button class="page-btn">243</button>
            <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
        </div>
    </div>
</div>

{{-- MODAL TRANSAKSI BARU --}}
<div class="modal" id="modalTransaksi">
    <div class="modal-dialog modal-lg">
        <div class="modal-head">
            <h3>Transaksi Baru</h3>
            <button class="modal-close" onclick="closeModal('modalTransaksi')"><i class="ti ti-x"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Customer <span class="required">*</span></label>
                    <select class="form-control">
                        <option>-- Pilih Customer --</option>
                        <option>Ahmad Fauzi</option>
                        <option>Siti Nurhaliza</option>
                        <option>Budi Santoso</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal <span class="required">*</span></label>
                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" />
                </div>
            </div>

            <div style="padding: 14px; background: var(--surface-2); border-radius: 10px; margin-bottom: 16px;">
                <div style="font-weight: 600; font-size: 13px; margin-bottom: 10px;">Item Produk</div>
                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 8px;">
                        <select class="form-control">
                            <option>-- Pilih Produk --</option>
                            <option>Beras Premium 5kg</option>
                            <option>Minyak Goreng 2L</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 8px;">
                        <input type="number" class="form-control" placeholder="Qty" />
                    </div>
                </div>
                <button class="btn btn-outline btn-sm" style="width: 100%;">
                    <i class="ti ti-plus"></i> Tambah Item
                </button>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Metode Pembayaran <span class="required">*</span></label>
                    <select class="form-control">
                        <option>Cash</option>
                        <option>Transfer</option>
                        <option>QRIS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control">
                        <option>Selesai</option>
                        <option>Pending</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" placeholder="Catatan tambahan..."></textarea>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-outline" onclick="closeModal('modalTransaksi')">Batal</button>
            <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan Transaksi</button>
        </div>
    </div>
</div>

@endsection
