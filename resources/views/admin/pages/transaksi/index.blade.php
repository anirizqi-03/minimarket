@extends('admin.layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

{{-- ============ PAGE HEADER ============ --}}
<div class="page-header">
    <div>
        <h1 class="page-title">Riwayat Transaksi</h1>
        <p class="page-sub">Semua transaksi penjualan minimarket</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('admin.transaksi.index', ['date_from' => today()->format('Y-m-d'), 'date_to' => today()->format('Y-m-d')]) }}"
           class="btn btn-outline">
            <i class="ti ti-calendar-today"></i> Hari Ini
        </a>
        <a href="{{ route('admin.kasir.index') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Transaksi Baru
        </a>
    </div>
</div>

{{-- ============ STAT CARDS ============ --}}
<div class="stat-grid" style="grid-template-columns: repeat(4, minmax(0, 1fr));">

    <div class="stat-card">
        <div class="stat-icon stat-icon--blue"><i class="ti ti-receipt"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Transaksi</p>
            <div class="stat-value">{{ number_format($stats['total_count'], 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-check"></i> Selesai</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--green"><i class="ti ti-currency-dollar"></i></div>
        <div class="stat-info">
            <p class="stat-label">Total Pendapatan</p>
            <div class="stat-value">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> Semua waktu</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--purple"><i class="ti ti-calendar"></i></div>
        <div class="stat-info">
            <p class="stat-label">Transaksi Hari Ini</p>
            <div class="stat-value">{{ number_format($stats['today_count'], 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-clock"></i> {{ now()->translatedFormat('d M Y') }}</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon--orange"><i class="ti ti-cash"></i></div>
        <div class="stat-info">
            <p class="stat-label">Pendapatan Hari Ini</p>
            <div class="stat-value">Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</div>
            <span class="stat-trend up"><i class="ti ti-trending-up"></i> Hari ini</span>
        </div>
    </div>

</div>

{{-- ============ TABLE ============ --}}
<div class="card">
    <div class="card-head">
        <div>
            <h3 class="card-title">Daftar Transaksi</h3>
            <p class="card-sub">Semua transaksi tercatat</p>
        </div>
    </div>

    {{-- FILTER FORM --}}
    <form method="GET" action="{{ route('admin.transaksi.index') }}">
        <div class="filter-bar">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari kode / customer / telp..."
                   value="{{ request('search') }}" />

            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="paid"      {{ request('status') == 'paid'      ? 'selected' : '' }}>Selesai</option>
                <option value="draft"     {{ request('status') == 'draft'     ? 'selected' : '' }}>Draft</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Batal</option>
            </select>

            <select name="payment_method" class="form-control">
                <option value="">Semua Metode</option>
                <option value="tunai" {{ request('payment_method') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="qris"  {{ request('payment_method') == 'qris'  ? 'selected' : '' }}>QRIS</option>
                <option value="debit" {{ request('payment_method') == 'debit' ? 'selected' : '' }}>Debit</option>
            </select>

            <input type="date"
                   name="date_from"
                   class="form-control"
                   value="{{ request('date_from') }}" />

            <input type="date"
                   name="date_to"
                   class="form-control"
                   value="{{ request('date_to') }}" />

            <div style="display: flex; gap: 6px;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    <i class="ti ti-filter"></i> Filter
                </button>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline">
                    <i class="ti ti-refresh"></i>
                </a>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Kode Transaksi</th>
                    <th>Customer</th>
                    <th>Kasir</th>
                    <th class="text-right">Total</th>
                    <th class="text-center">Metode</th>
                    <th class="text-center">Status</th>
                    <th>Tanggal</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $trx)
                    @php
                        $statusMap = [
                            'paid'      => ['label' => 'Selesai', 'badge' => 'success'],
                            'draft'     => ['label' => 'Draft',   'badge' => 'warning'],
                            'cancelled' => ['label' => 'Batal',   'badge' => 'danger'],
                        ];
                        $status = $statusMap[$trx->status] ?? ['label' => $trx->status, 'badge' => 'gray'];
                    @endphp
                    <tr>
                        <td>{{ $transactions->firstItem() + $index }}</td>
                        <td>
                            <strong style="font-family: 'Courier New', monospace; font-size: 12.5px;">
                                {{ $trx->code }}
                            </strong>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $trx->customer_name }}</strong>
                                @if($trx->customer_phone)
                                    <div style="font-size: 11px; color: var(--text-3);">{{ $trx->customer_phone }}</div>
                                @endif
                            </div>
                        </td>
                        <td>{{ $trx->user->name ?? '-' }}</td>
                        <td class="text-right">
                            <strong style="color: var(--primary); font-size: 13.5px;">
                                Rp {{ number_format($trx->total, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td class="text-center">
                            <span class="badge badge--gray">{{ strtoupper($trx->payment_method) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge--{{ $status['badge'] }}">{{ $status['label'] }}</span>
                        </td>
                        <td>
                            <div style="font-size: 12.5px;">{{ $trx->created_at->format('d/m/Y') }}</div>
                            <div style="font-size: 11px; color: var(--text-3);">{{ $trx->created_at->format('H:i') }}</div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.transaksi.show', $trx) }}"
                                   class="btn btn-outline btn-sm btn-icon"
                                   title="Detail">
                                    <i class="ti ti-eye"></i>
                                </a>

                                <a href="{{ route('admin.kasir.receipt', $trx) }}"
                                   target="_blank"
                                   class="btn btn-outline btn-sm btn-icon"
                                   title="Cetak Struk">
                                    <i class="ti ti-printer"></i>
                                </a>

                                @if($trx->status === 'paid')
                                    <form action="{{ route('admin.transaksi.destroy', $trx) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin batalkan transaksi {{ $trx->code }}?')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline btn-sm btn-icon"
                                                style="color: var(--red);"
                                                title="Batalkan">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="icon">📋</div>
                                <strong>Belum Ada Transaksi</strong>
                                <p>
                                    @if(request()->anyFilled(['search', 'status', 'payment_method', 'date_from', 'date_to']))
                                        Tidak ada transaksi yang cocok dengan filter.
                                    @else
                                        Transaksi baru akan muncul di sini setelah kasir memproses penjualan.
                                    @endif
                                </p>
                                @if(request()->anyFilled(['search', 'status', 'payment_method', 'date_from', 'date_to']))
                                    <a href="{{ route('admin.transaksi.index') }}"
                                       class="btn btn-outline"
                                       style="margin-top: 16px; display: inline-flex;">
                                        <i class="ti ti-refresh"></i> Reset Filter
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($transactions->hasPages())
        <div class="pagination">
            <span class="pagination-info">
                Menampilkan {{ $transactions->firstItem() }}–{{ $transactions->lastItem() }}
                dari {{ number_format($transactions->total(), 0, ',', '.') }} transaksi
            </span>
            <div class="pagination-controls">
                {{-- Prev --}}
                @if($transactions->onFirstPage())
                    <button class="page-btn" disabled style="opacity: 0.4;">
                        <i class="ti ti-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $transactions->previousPageUrl() }}" class="page-btn">
                        <i class="ti ti-chevron-left"></i>
                    </a>
                @endif

                {{-- Page numbers --}}
                @foreach($transactions->links()->elements as $element)
                    @if(is_string($element))
                        <span class="page-btn" style="cursor: default;">{{ $element }}</span>
                    @endif
                    @if(is_array($element))
                        @foreach($element as $page => $url)
                            @if($page == $transactions->currentPage())
                                <button class="page-btn active">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}" class="page-btn">
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

@endsection
