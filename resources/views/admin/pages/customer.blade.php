@extends('admin.layouts.app')

@section('title', 'Customer')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Data Customer</h1>
        <p class="page-sub">Kelola data customer minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <button class="btn btn-primary" onclick="openModal('modalCustomer')">
            <i class="ti ti-plus"></i> Tambah Customer
        </button>
    </div>
</div>

<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-users"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Customer</p>
            <div class="stat-value">1.245</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-user-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Customer Aktif</p>
            <div class="stat-value">1.180</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-user-plus"></i></div>
        <div class="stat-info">
            <p class="stat-label">Baru Bulan Ini</p>
            <div class="stat-value">65</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon--orange"><i class="ti ti-crown"></i></div>
        <div class="stat-info">
            <p class="stat-label">Member Premium</p>
            <div class="stat-value">124</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Customer</h3>
            <p class="card-sub">Semua customer terdaftar</p>
        </div>
        <div class="search-box" style="max-width: 260px;">
            <i class="ti ti-search"></i>
            <input type="text" placeholder="Cari customer..." />
        </div>
    </div>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Customer</th>
                    <th>Kontak</th>
                    <th class="text-center">Transaksi</th>
                    <th class="text-right">Total Belanja</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $customers = [
                        ['no' => 1, 'nama' => 'Ahmad Fauzi', 'email' => 'ahmad@email.com', 'telp' => '0812-1111-2222', 'trx' => 25, 'total' => 3500000, 'status' => 'Aktif', 'color' => 'green'],
                        ['no' => 2, 'nama' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'telp' => '0813-3333-4444', 'trx' => 18, 'total' => 2100000, 'status' => 'Aktif', 'color' => 'blue'],
                        ['no' => 3, 'nama' => 'Budi Santoso', 'email' => 'budi@email.com', 'telp' => '0814-5555-6666', 'trx' => 12, 'total' => 1800000, 'status' => 'Aktif', 'color' => 'purple'],
                        ['no' => 4, 'nama' => 'Dewi Lestari', 'email' => 'dewi@email.com', 'telp' => '0815-7777-8888', 'trx' => 8, 'total' => 950000, 'status' => 'Aktif', 'color' => 'orange'],
                        ['no' => 5, 'nama' => 'Rizki Pratama', 'email' => 'rizki@email.com', 'telp' => '0816-9999-0000', 'trx' => 15, 'total' => 2400000, 'status' => 'Nonaktif', 'color' => 'teal'],
                    ];
                @endphp

                @foreach($customers as $c)
                    @php
                        $initial = collect(explode(' ', $c['nama']))->map(fn($w) => $w[0])->take(2)->implode('');
                    @endphp
                    <tr>
                        <td>{{ $c['no'] }}</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar avatar--{{ $c['color'] }}">{{ $initial }}</div>
                                <div>
                                    <strong style="display:block;">{{ $c['nama'] }}</strong>
                                    <span style="font-size:11.5px; color: var(--text-3);">{{ $c['email'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $c['telp'] }}</td>
                        <td class="text-center"><strong>{{ $c['trx'] }}</strong></td>
                        <td class="text-right"><strong>Rp {{ number_format($c['total'], 0, ',', '.') }}</strong></td>
                        <td class="text-center">
                            <span class="badge badge--{{ $c['status'] === 'Aktif' ? 'success' : 'gray' }}">{{ $c['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="btn btn-outline btn-sm btn-icon" title="Detail"><i class="ti ti-eye"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Edit" onclick="openModal('modalCustomer')"><i class="ti ti-pencil"></i></button>
                                <button class="btn btn-outline btn-sm btn-icon" title="Hapus" onclick="openModal('modalHapus')" style="color: var(--red);"><i class="ti ti-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <span class="pagination-info">Menampilkan 1–5 dari 1.245 customer</span>
        <div class="pagination-controls">
            <button class="page-btn"><i class="ti ti-chevron-left"></i></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal" id="modalCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-head">
            <h3>Tambah Customer</h3>
            <button class="modal-close" onclick="closeModal('modalCustomer')"><i class="ti ti-x"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="Mis: Ahmad Fauzi" />
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon <span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="0812-xxxx-xxxx" />
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" class="form-control" placeholder="customer@email.com" />
            </div>
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" placeholder="Alamat lengkap..."></textarea>
            </div>
            <div class="form-row">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
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
            <button class="btn btn-outline" onclick="closeModal('modalCustomer')">Batal</button>
            <button class="btn btn-primary"><i class="ti ti-device-floppy"></i> Simpan</button>
        </div>
    </div>
</div>

@endsection
