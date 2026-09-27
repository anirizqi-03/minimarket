@extends('admin.layouts.app')

@section('title', 'Katalog Produk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Katalog Produk</h1>
        <p class="page-sub">Kelola semua produk minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-upload"></i> Import</button>
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <button class="btn btn-primary" onclick="openModal('modalProduk')">
            <i class="ti ti-plus"></i> Tambah Produk
        </button>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-package"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Produk</p>
            <div class="stat-value">568</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Tersedia</p>
            <div class="stat-value">540</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--yellow"><i class="ti ti-alert-triangle"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Menipis</p>
            <div class="stat-value">14</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--red"><i class="ti ti-x"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Habis</p>
            <div class="stat-value">14</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Produk</h3>
            <p class="card-sub">Semua produk terdaftar</p>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="filter-bar">
        <input type="text" class="form-control" placeholder="Cari produk..." />
        <select class="form-control">
            <option>Semua Kategori</option>
            <option>Makanan</option>
            <option>Minuman</option>
            <option>Snack</option>
        </select>
        <select class="form-control">
            <option>Semua Supplier</option>
            <option>PT Sejahtera</option>
            <option>CV Maju Jaya</option>
        </select>
        <select class="form-control">
            <option>Semua Status</option>
            <option>Tersedia</option>
            <option>Stok Menipis</option>
            <option>Habis</option>
        </select>
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $produk = [
                        ['no' => 1, 'nama' => 'Beras Premium 5kg', 'kat' => 'Makanan', 'sup' => 'PT Sejahtera', 'harga' => 75000, 'stok' => 245, 'status' => 'Tersedia'],
                        ['no' => 2, 'nama' => 'Minyak Goreng 2L', 'kat' => 'Makanan', 'sup' => 'PT Sejahtera', 'harga' => 38000, 'stok' => 198, 'status' => 'Tersedia'],
                        ['no' => 3, 'nama' => 'Teh Kotak 1L', 'kat' => 'Minuman', 'sup' => 'CV Maju Jaya', 'harga' => 12000, 'stok' => 176, 'status' => 'Tersedia'],
                        ['no' => 4, 'nama' => 'Biskuit Cokelat', 'kat' => 'Snack', 'sup' => 'PT Rasa Nikmat', 'harga' => 15000, 'stok' => 152, 'status' => 'Tersedia'],
                        ['no' => 5, 'nama' => 'Sabun Mandi', 'kat' => 'Kebutuhan Rumah', 'sup' => 'PT Bersih Selalu', 'harga' => 8500, 'stok' => 134, 'status' => 'Tersedia'],
                        ['no' => 6, 'nama' => 'Pasta Gigi', 'kat' => 'Perawatan Diri', 'sup' => 'PT Bersih Selalu', 'harga' => 18000, 'stok' => 8, 'status' => 'Stok Menipis'],
                        ['no' => 7, 'nama' => 'Apel Merah 1kg', 'kat' => 'Sayuran & Buah', 'sup' => 'CV Tani Makmur', 'harga' => 35000, 'stok' => 45, 'status' => 'Tersedia'],
                        ['no' => 8, 'nama' => 'Air Mineral 1.5L', 'kat' => 'Minuman', 'sup' => 'CV Maju Jaya', 'harga' => 6000, 'stok' => 320, 'status' => 'Tersedia'],
                    ];
                @endphp

                @foreach($produk as $p)
                    @php
                        $badgeMap = ['Tersedia' => 'success', 'Stok Menipis' => 'warning', 'Habis' => 'danger'];
                    @endphp
                    <tr>
                        <td>{{ $p['no'] }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar--purple"><i class="ti ti-package"></i></div>
                                <strong>{{ $p['nama'] }}</strong>
                            </div>
                        </td>
                        <td><span class="badge badge--gray">{{ $p['kat'] }}</span></td>
                        <td>{{ $p['sup'] }}</td>
                        <td class="text-right"><strong>Rp {{ number_format($p['harga'], 0, ',', '.') }}</strong></td>
                        <td class="text-center"><strong>{{ $p['stok'] }}</strong></td>
                        <td class="text-center">
                            <span class="badge badge--{{ $badgeMap[$p['status']] }}">{{ $p['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="btn btn-outline btn-sm btn-icon" title="Detail"><i class="ti ti-eye"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Edit" onclick="openModal('modalProduk')"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Hapus" onclick="openModal('modalHapus')" style="color: var(--red);"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-info">Menampilkan 1–8 dari 568 produk</span>
        <div class="pagination-controls">
            <button class="page-btn"><i class="ti ti-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">...</button>
            <button class="page-btn">71</button>
            <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal" id="modalProduk">
    <div class="modal-dialog modal-lg">
        <div class="modal-head">
            <h3>Tambah Produk</h3>
            <button class="modal-close" onclick="closeModal('modalProduk')"><i class="ti ti-x"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Nama Produk <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Mis: Beras Premium 5kg" />
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select class="form-control">
                        <option>Makanan</option>
                        <option>Minuman</option>
                        <option>Snack</option>
                        <option>Kebutuhan Rumah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Supplier <span class="required">*</span></label>
                    <select class="form-control">
                        <option>PT Sejahtera</option>
                        <option>CV Maju Jaya</option>
                        <option>PT Rasa Nikmat</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga <span class="required">*</span></label>
                    <input type="number" class="form-control" placeholder="0" />
                </div>
                <div class="form-group">
                    <label class="form-label">Stok <span class="required">*</span></label>
                    <input type="number" class="form-control" placeholder="0" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <select class="form-control">
                        <option>pcs</option>
                        <option>kg</option>
                        <option>liter</option>
                        <option>box</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Berat</label>
                    <input type="text" class="form-control" placeholder="Mis: 5 kg" />
                </div>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" placeholder="Deskripsi produk..."></textarea>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-outline" onclick="closeModal('modalProduk')">Batal</button>
            <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
        </div>
    </div>
</div>

@endsection
