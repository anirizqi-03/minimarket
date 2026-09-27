@extends('admin.layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="page-header">
    <div>
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <a href="{{ route('admin.products.index') }}" class="back-link">
                <i class="ti ti-arrow-left"></i>
            </a>
            <h1 class="page-title" style="margin: 0;">Detail Produk</h1>
        </div>
        <p class="page-sub">Informasi lengkap produk</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="ti ti-pencil"></i> Edit Produk
        </a>
    </div>
</div>

@php
    if ($product->stock <= 0) {
        $status = 'Habis';       $badge = 'danger';
    } elseif ($product->stock <= 10) {
        $status = 'Stok Menipis'; $badge = 'warning';
    } else {
        $status = 'Tersedia';    $badge = 'success';
    }
@endphp

<div class="grid-2" style="grid-template-columns: 2fr 1fr;">

    {{-- Kiri: Info Utama --}}
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title">Informasi Produk</h3>
            </div>
        </div>

        <div class="card-body">

            {{-- Header Produk --}}
            <div style="display: flex; gap: 16px; align-items: center; padding: 16px; background: var(--surface-2); border-radius: 12px; margin-bottom: 20px;">
                <div class="avatar avatar--green avatar-lg" style="font-size: 20px;">
                    <i class="ti ti-shopping-bag"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h3 style="font-size: 18px; margin-bottom: 6px;">{{ $product->name }}</h3>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        @if($product->category)
                            <span class="badge badge--gray">{{ $product->category }}</span>
                        @endif
                        <span class="badge badge--{{ $badge }}">{{ $status }}</span>
                        <span class="badge badge--{{ $product->is_active ? 'success' : 'gray' }}">
                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Info Grid --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px 24px;">

                <div>
                    <p class="info-label">ID Produk</p>
                    <p class="info-value">#{{ $product->id }}</p>
                </div>
                <div>
                    <p class="info-label">SKU</p>
                    <p class="info-value">PRD-{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <p class="info-label">Kategori</p>
                    <p class="info-value">{{ $product->category ?? '—' }}</p>
                </div>
                <div>
                    <p class="info-label">Status Stok</p>
                    <p class="info-value">{{ $status }}</p>
                </div>
                <div>
                    <p class="info-label">Harga</p>
                    <p class="info-value" style="color: var(--primary); font-size: 16px;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="info-label">Stok</p>
                    <p class="info-value" style="font-size: 16px;">
                        {{ $product->stock }} pcs
                    </p>
                </div>

            </div>

            @if($product->description)
                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-soft);">
                    <p class="info-label" style="margin-bottom: 6px;">Deskripsi</p>
                    <p style="color: var(--text-2); line-height: 1.6; font-size: 13.5px;">
                        {{ $product->description }}
                    </p>
                </div>
            @endif

            @if($product->image)
                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-soft);">
                    <p class="info-label" style="margin-bottom: 6px;">Gambar</p>
                    <p style="color: var(--text-2); font-size: 13px;">
                        <code style="background: var(--surface-3); padding: 4px 8px; border-radius: 6px;">
                            {{ $product->image }}
                        </code>
                    </p>
                </div>
            @endif

        </div>
    </div>

    {{-- Kanan: Sidebar Info --}}
    <div>
        <div class="card" style="margin-bottom: 16px;">
            <div class="card-head">
                <h3 class="card-title">Ringkasan Nilai</h3>
            </div>
            <div class="card-body">
                <div style="margin-bottom: 14px;">
                    <p class="info-label">Nilai Stok</p>
                    <p style="font-size: 18px; font-weight: 800; color: var(--primary);">
                        Rp {{ number_format($product->price * $product->stock, 0, ',', '.') }}
                    </p>
                </div>

                <div style="margin-bottom: 14px;">
                    <p class="info-label">Harga Satuan</p>
                    <p style="font-size: 15px; font-weight: 700;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="info-label">Kuantitas</p>
                    <p style="font-size: 15px; font-weight: 700;">
                        {{ $product->stock }} pcs
                    </p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <h3 class="card-title">Timeline</h3>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
                    <div>
                        <p class="info-label" style="margin-bottom: 2px;">Dibuat</p>
                        <p style="font-weight: 600;">
                            {{ $product->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        <p class="info-label" style="margin-bottom: 2px;">Terakhir Diupdate</p>
                        <p style="font-weight: 600;">
                            {{ $product->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .back-link {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: var(--surface);
        border: 1px solid var(--border);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--text-2);
        transition: all 0.15s;
    }
    .back-link:hover {
        background: var(--surface-3);
        color: var(--primary);
    }
    .info-label {
        font-size: 11.5px;
        color: var(--text-3);
        margin-bottom: 3px;
        font-weight: 500;
    }
    .info-value {
        font-weight: 600;
        color: var(--text);
        font-size: 14px;
    }
    @media (max-width: 900px) {
        .grid-2 { grid-template-columns: 1fr !important; }
    }
</style>

@endsection
