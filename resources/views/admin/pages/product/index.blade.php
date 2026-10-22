@extends('admin.layouts.app')

@section('title', 'Produk')

@section('content')

{{-- ============ PAGE HEADER ============ --}}
<div class="page-header">
    <div>
        <h1 class="page-title">Produk</h1>
        <p class="page-sub">Kelola semua produk minimarket</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline"><i class="ti ti-upload"></i> Import</button>
        <button class="btn btn-outline"><i class="ti ti-download"></i> Export</button>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Produk
        </a>
    </div>
</div>

{{-- ============ ALERT ============ --}}
@if(session('success'))
    <div class="alert-success">
        <i class="ti ti-circle-check"></i>
        <span>{{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" class="alert-close">
            <i class="ti ti-x"></i>
        </button>
    </div>
@endif

{{-- ============ STAT CARDS ============ --}}
@php
    $total    = $products->total();
    $tersedia = \App\Models\Product::where('stock', '>', 10)->count();
    $menipis  = \App\Models\Product::whereBetween('stock', [1, 10])->count();
    $habis    = \App\Models\Product::where('stock', 0)->count();
@endphp

<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">
    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-shopping-bag"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Produk</p>
            <div class="stat-value">{{ number_format($total, 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> Semua produk</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-check"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Tersedia</p>
            <div class="stat-value">{{ number_format($tersedia, 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-check"></i> Normal</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--yellow"><i class="ti ti-alert-triangle"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Menipis</p>
            <div class="stat-value">{{ number_format($menipis, 0, ',', '.') }}</div>
            <span class="stat-trend down"><i class="ti ti-alert-circle"></i> Perlu restock</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--red"><i class="ti ti-x"></i></div>
        <div class="stat-info">
            <p class="stat-label">Stok Habis</p>
            <div class="stat-value">{{ number_format($habis, 0, ',', '.') }}</div>
            <span class="stat-trend down"><i class="ti ti-alert-circle"></i> Segera restock</span>
        </div>
    </div>
</div>

{{-- ============ TABLE ============ --}}
<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Produk</h3>
            <p class="card-sub">Semua produk terdaftar</p>
        </div>
        <div class="search-box" style="max-width: 280px;">
            <i class="ti ti-search"></i>
            <input type="text" placeholder="Cari produk..." />
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <select class="form-control">
            <option>Semua Kategori</option>
            <option>Makanan</option>
            <option>Minuman</option>
            <option>Snack</option>
            <option>Kebutuhan Rumah</option>
            <option>Perawatan Diri</option>
        </select>

        <select class="form-control">
            <option>Semua Status</option>
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>

        <select class="form-control">
            <option>Urutkan: Terbaru</option>
            <option>Harga: Rendah - Tinggi</option>
            <option>Harga: Tinggi - Rendah</option>
            <option>Stok: Sedikit - Banyak</option>
        </select>
    </div>

    {{-- TABLE --}}
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 40px;"><input type="checkbox" /></th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Gambar</th>
                    <th class="text-center" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
    <tbody>
        @forelse($products as $product)
            @php
                // Status stok
                if ($product->stock <= 0) {
                    $status = 'Habis';        $badge = 'danger';
                } elseif ($product->stock <= 10) {
                    $status = 'Stok Menipis'; $badge = 'warning';
                } else {
                    $status = 'Tersedia';     $badge = 'success';
                }
            @endphp

            <tr>
                <td><input type="checkbox" /></td>

                {{-- 1. Nama & SKU --}}
                <td>
                    <strong style="display: block; color: var(--text);">{{ $product->name }}</strong>
                    <span style="font-size: 11.5px; color: var(--text-3);">
                        SKU: {{ $product->sku ?? 'PRD-' . str_pad($product->id, 3, '0', STR_PAD_LEFT) }}
                    </span>
                </td>

                {{-- 2. Kategori (Diperbaiki jadi string biasa) --}}
                <td>
                    <span class="badge badge--gray">{{ $product->category ?? '—' }}</span>
                </td>

                {{-- 3. Harga --}}
                <td class="text-right">
                    <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                </td>

                {{-- 4. Stok --}}
                <td class="text-center">
                    <strong>{{ $product->stock }}</strong>
                </td>

                {{-- 5. Status --}}
                <td class="text-center">
                    <span class="badge badge--{{ $badge }}">{{ $status }}</span>
                </td>

                {{-- 6. Gambar (HANYA TAMPILKAN GAMBAR, TANPA TEKS) --}}
                <td class="text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px; display: block; margin: 0 auto;">
                    @else
                        <div class="avatar avatar--green" style="margin: 0 auto;">
                            <i class="ti ti-shopping-bag"></i>
                        </div>
                    @endif
                </td>

                {{-- 7. Aksi --}}
                <td class="text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline btn-sm btn-icon" title="Detail">
                            <i class="ti ti-eye"></i>
                        </a>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm btn-icon" title="Edit">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus produk {{ $product->name }}?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm btn-icon" title="Hapus" style="color: var(--red);">
                                <i class="ti ti-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">
                    <div class="empty-state">
                        <div class="icon">📦</div>
                        <strong>Belum Ada Produk</strong>
                        <p>Silakan tambahkan produk pertama Anda.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
    </div>

    {{-- PAGINATION --}}
    @if($products->hasPages())
        <div class="pagination">
            <span class="pagination-info">
                Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }}
                dari {{ number_format($products->total(), 0, ',', '.') }} produk
            </span>
            <div class="pagination-controls">
                {{-- Prev --}}
                @if($products->onFirstPage())
                    <button class="page-btn" disabled style="opacity: 0.4;">
                        <i class="ti ti-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="page-btn">
                        <i class="ti ti-chevron-left"></i>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <button class="page-btn active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="page-btn">
                        <i class="ti ti-chevron-right"></i>
                    </a>
                @else
                    <button class="page-btn" disabled style="opacity: 0.4;">
                        <i class="ti ti-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>

{{-- ============ STYLE ALERT ============ --}}
<style>
    .alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        background: var(--primary-soft);
        color: var(--primary-dark);
        border: 1px solid #86efac;
        border-radius: var(--radius);
        margin-bottom: 20px;
        font-size: 13.5px;
        font-weight: 500;
    }
    .alert-success i:first-child {
        font-size: 20px;
        flex-shrink: 0;
    }
    .alert-success .alert-close {
        margin-left: auto;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-dark);
    }
    .alert-success .alert-close:hover {
        background: rgba(0, 0, 0, 0.06);
    }
</style>

@endsection
