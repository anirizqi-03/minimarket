@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')

{{-- ============ PAGE HEADER ============ --}}
<div class="page-header">
    <div>
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <a href="{{ route('admin.products.index') }}" class="back-link">
                <i class="ti ti-arrow-left"></i>
            </a>
            <h1 class="page-title" style="margin: 0;">Tambah Produk</h1>
        </div>
        <p class="page-sub">Tambahkan produk baru ke katalog minimarket</p>
    </div>
</div>

{{-- ============ CARD FORM ============ --}}
<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Informasi Produk</h3>
            <p class="card-sub">Isi semua field yang bertanda <span style="color: var(--red);">*</span></p>
        </div>
    </div>

    <div class="card-body">
        @include('admin.pages.product._form', [
            'action' => route('admin.products.store'),
            'method' => 'POST',
            'button' => 'Simpan Produk',
        ])

        <div class="form-actions">
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                <i class="ti ti-x"></i> Batal
            </a>
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
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--border-soft);
    }
</style>

@endsection
