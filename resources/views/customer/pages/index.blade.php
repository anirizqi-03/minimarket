@extends('customer.layouts.app')

@section('title', 'Beranda - Minimarket')

@section('content')

    @if(session('success'))
        <div class="flash-alert flash-alert--success" id="flashAlert">
            <div class="flash-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12l5 5L20 7"/>
                </svg>
            </div>
            <div class="flash-alert-text">{{ session('success') }}</div>
            <button type="button" class="flash-alert-close" onclick="document.getElementById('flashAlert').remove()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="flash-alert flash-alert--error" id="flashAlert">
            <div class="flash-alert-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
            </div>
            <div class="flash-alert-text">{{ session('error') }}</div>
            <button type="button" class="flash-alert-close" onclick="document.getElementById('flashAlert').remove()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif



    <!-- Hero Slider Section -->
    @include('customer.partials.hero-slider')

    <!-- Featured Categories Section -->
    @include('customer.partials.featured-categories')

    <!-- Promo Banners Section -->
    @include('customer.partials.promo-banners')

    <!-- Popular Products Section -->
    @include('customer.partials.popular-products')

    <!-- Quick View Modal -->
    @include('customer.partials.modal-product')
@endsection
