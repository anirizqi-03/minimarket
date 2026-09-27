@extends('admin.layouts.app')

@section('title', 'Supplier')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Supplier</h1>
        <p class="page-sub">Kelola data supplier minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <button class="btn btn-primary" onclick="openModal('modalSupplier')">
            <i class="ti ti-plus"></i> Tambah Supplier
        </button>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--teal"><i class="ti ti-truck"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Supplier</p>
            <div class="stat-value">8</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Supplier Aktif</p>
            <div class="stat-value">7</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-package"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Produk Disupply</p>
            <div class="stat-value">148</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-shopping-cart"></i></div>
        <div class="stat-info">
            <p class="stat-label">PO Bulan Ini</p>
            <div class="stat-value">24</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Supplier</h3>
            <p class="card-sub">Semua supplier terdaftar</p>
        </div>
        <div class="search-box" style="max-width: 260px;">
            <i class="ti ti-search"></i>
            <input type="text" placeholder="Cari supplier..." />
        </div>
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Nama Supplier</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th class="text-center">Total Produk</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $suppliers = [
                        ['no' => 1, 'nama' => 'PT Sejahtera', 'kontak' => '0812-3456-7890', 'email' => 'info@sejahtera.co.id', 'alamat' => 'Jakarta', 'produk' => 45, 'status' => 'Aktif', 'color' => 'green'],
                        ['no' => 2, 'nama' => 'CV Maju Jaya', 'kontak' => '0813-5678-9012', 'email' => 'sales@majujaya.com', 'alamat' => 'Bandung', 'produk' => 32, 'status' => 'Aktif', 'color' => 'blue'],
                        ['no' => 3, 'nama' => 'PT Rasa Nikmat', 'kontak' => '0814-7890-1234', 'email' => 'order@rasanikmat.id', 'alamat' => 'Surabaya', 'produk' => 28, 'status' => 'Aktif', 'color' => 'purple'],
                        ['no' => 4, 'nama' => 'PT Bersih Selalu', 'kontak' => '0815-9012-3456', 'email' => 'cs@bersihselalu.com', 'alamat' => 'Semarang', 'produk' => 19, 'status' => 'Aktif', 'color' => 'orange'],
                        ['no' => 5, 'nama' => 'CV Tani Makmur', 'kontak' => '0816-1234-5678', 'email' => 'tani@makmur.co.id', 'alamat' => 'Malang', 'produk' => 24, 'status' => 'Nonaktif', 'color' => 'teal'],
                    ];
                @endphp

                @foreach($suppliers as $s)
                    @php
                        $initial = collect(explode(' ', $s['nama']))->map(fn($w) => $w[0])->take(2)->implode('');
                    @endphp
                    <tr>
                        <td>{{ $s['no'] }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar--{{ $s['color'] }}">{{ $initial }}</div>
                                <div>
                                    <strong style="display:block;">{{ $s['nama'] }}</strong>
                                    <span style="font-size:11.5px; color: var(--text-3);">{{ $s['email'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $s['kontak'] }}</td>
                        <td>{{ $s['alamat'] }}</td>
                        <td class="text-center"><strong>{{ $s['produk'] }}</strong></td>
                        <td class="text-center">
                            <span class="badge badge--{{ $s['status'] === 'Aktif' ? 'success' : 'gray' }}">{{ $s['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="btn btn-outline btn-sm btn-icon" title="Detail"><i class="ti ti-eye"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Edit" onclick="openModal('modalSupplier')"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Hapus" onclick="openModal('modalHapus')" style="color: var(--red);"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-info">Menampilkan 1–5 dari 8 supplier</span>
        <div class="pagination-controls">
            <button class="page-btn"><i class="ti ti-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal" id="modalSupplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-head">
            <h3>Tambah Supplier</h3>
            <button class="modal-close" onclick="closeModal('modalSupplier')"><i class="ti ti-x"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Nama Supplier <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Mis: PT Sejahtera" />
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">No. Telepon <span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="0812-xxxx-xxxx" />
                </div>
                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" placeholder="supplier@email.com" />
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Alamat <span class="required">*</span></label>
                <textarea class="form-control" placeholder="Alamat lengkap supplier..."></textarea>
            </div>
            <div class="form-row">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Kontak Person</label>
                    <input type="text" class="form-control" placeholder="Nama PIC" />
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Status</label>
                    <select class="form-control">
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-outline" onclick="closeModal('modalSupplier')">Batal</button>
            <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
        </div>
    </div>
</div>

@endsection
