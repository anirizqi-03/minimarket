@extends('admin.layouts.app')

@section('title', 'Kategori Produk')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Kategori Produk</h1>
        <p class="page-sub">Kelola kategori produk minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <button class="btn btn-primary" onclick="openModal('modalKategori')">
            <i class="ti ti-plus"></i> Tambah Kategori
        </button>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stat-grid" style="grid-template-columns: repeat(3, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-category"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Kategori</p>
            <div class="stat-value">6</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-package"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Produk</p>
            <div class="stat-value">568</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--teal"><i class="ti ti-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Kategori Aktif</p>
            <div class="stat-value">6</div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Kategori</h3>
            <p class="card-sub">Semua kategori terdaftar</p>
        </div>
        <div class="search-box" style="max-width: 260px;">
            <i class="ti ti-search"></i>
            <input type="text" placeholder="Cari kategori..." />
        </div>
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th class="text-center">Jumlah Produk</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $kategori = [
                        ['no' => 1, 'nama' => 'Makanan', 'slug' => 'makanan', 'produk' => 145, 'status' => 'Aktif'],
                        ['no' => 2, 'nama' => 'Minuman', 'slug' => 'minuman', 'produk' => 98, 'status' => 'Aktif'],
                        ['no' => 3, 'nama' => 'Snack', 'slug' => 'snack', 'produk' => 87, 'status' => 'Aktif'],
                        ['no' => 4, 'nama' => 'Kebutuhan Rumah', 'slug' => 'kebutuhan-rumah', 'produk' => 120, 'status' => 'Aktif'],
                        ['no' => 5, 'nama' => 'Perawatan Diri', 'slug' => 'perawatan-diri', 'produk' => 65, 'status' => 'Aktif'],
                        ['no' => 6, 'nama' => 'Sayuran & Buah', 'slug' => 'sayuran-buah', 'produk' => 53, 'status' => 'Aktif'],
                    ];
                @endphp

                @foreach($kategori as $k)
                    <tr>
                        <td>{{ $k['no'] }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar--green"><i class="ti ti-category"></i></div>
                                <strong>{{ $k['nama'] }}</strong>
                            </div>
                        </td>
                        <td><code style="background: var(--surface-3); padding: 3px 8px; border-radius: 6px; font-size: 12px;">{{ $k['slug'] }}</code></td>
                        <td class="text-center"><strong>{{ $k['produk'] }}</strong></td>
                        <td class="text-center">
                            <span class="badge badge--success">{{ $k['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="btn btn-outline btn-sm btn-icon" title="Edit" onclick="openModal('modalKategori')">
                                    <i class="ti ti-pencil"></i>
                                </button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Hapus" onclick="openModal('modalHapus')" style="color: var(--red);">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-info">Menampilkan 1–6 dari 6 kategori</span>
        <div class="pagination-controls">
            <button class="page-btn"><i class="ti ti-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH/EDIT --}}
<div class="modal" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-head">
            <h3>Tambah Kategori</h3>
            <button class="modal-close" onclick="closeModal('modalKategori')"><i class="ti ti-x"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Nama Kategori <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Mis: Makanan Ringan" />
            </div>
            <div class="form-group">
                <label class="form-label">Slug <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="makanan-ringan" />
                <span class="form-hint">Slug akan digunakan sebagai URL kategori</span>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" placeholder="Deskripsi singkat kategori..."></textarea>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">Status</label>
                <select class="form-control">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-outline" onclick="closeModal('modalKategori')">Batal</button>
            <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
        </div>
    </div>
</div>

@endsection
