@extends('admin.layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="page-header">
    <div>
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
            <a href="{{ route('admin.products.index') }}" class="back-link">
                <i class="ti ti-arrow-left"></i>
            </a>
            <h1 class="page-title" style="margin: 0;">Edit Produk</h1>
        </div>
        <p class="page-sub">Perbarui informasi produk {{ $product->name }}</p>
    </div>
</div>

<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Informasi Produk</h3>
            <p class="card-sub">
                ID: <strong>#{{ $product->id }}</strong> &middot;
                Dibuat {{ $product->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>

    <div class="card-body">
        @include('admin.pages.product._form', [
            'action' => route('admin.products.update', $product),
            'method' => 'PUT',
            'button' => 'Update Produk',
        ])

        <div class="form-actions">
            <form action="{{ route('admin.products.destroy', $product) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin hapus produk ini?')"
                  style="margin-right: auto;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline" style="color: var(--red); border-color: var(--red);">
                    <i class="ti ti-trash"></i> Hapus
                </button>
            </form>

            <a href="{{ route('admin.products.index') }}" class="btn btn-outline">
                <i class="ti ti-x"></i> Batal
            </a>
            <button type="submit" form="formProduk" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Update Produk
            </button>
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
        align-items: center;
        gap: 8px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid var(--border-soft);
    }
</style>

@endsection
