@php
    $menu = [
        'Menu Utama' => [
            [
                'label' => 'Dashboard',
                'icon'  => 'ti-layout-dashboard',
                'href'  => route('admin.dashboard'),
                'route' => 'admin.dashboard',
            ],
        ],
        'Master Data' => [
            [
                'label' => 'Produk',
                'icon'  => 'ti-shopping-bag',
                'href'  => route('admin.products.index'),
                'route' => 'admin.products',
            ],
            [
                'label' => 'Kategori Produk',
                'icon'  => 'ti-category',
                'href'  => '#',
                'route' => 'admin.categories',
            ],
            [
                'label' => 'Katalog Produk',
                'icon'  => 'ti-package',
                'href'  => '#',
                'route' => 'admin.katalog',
            ],
            [
                'label' => 'Supplier',
                'icon'  => 'ti-truck',
                'href'  => '#',
                'route' => 'admin.suppliers',
            ],
            [
                'label' => 'Customer',
                'icon'  => 'ti-users',
                'href'  => '#',
                'route' => 'admin.customers',
            ],
        ],
        'Transaksi' => [
            [
                'label' => 'Kasir',
                'icon'  => 'ti-cash',
                'href'  => route('admin.kasir.index'),
                'route' => 'admin.kasir',
            ],
            [
                'label' => 'Riwayat Transaksi',
                'icon'  => 'ti-receipt',
                'href'  => route('admin.transaksi.index'),
                'badge' => '5',
                'route' => 'admin.transactions',
            ],
        ],
        'Lainnya' => [
            [
                'label' => 'Pengaturan',
                'icon'  => 'ti-settings',
                'href'  => '#',
                'route' => 'admin.settings',
            ],
        ],
    ];
@endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">
            <div class="sidebar-brand-icon">🛒</div>
            <div class="sidebar-brand-text">
                <h1>Minimarket</h1>
                <span>Admin Panel</span>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        @foreach($menu as $section => $items)
            <span class="nav-label">{{ $section }}</span>

            @foreach($items as $item)
                @php
                    $isActive = false;
                    if (!empty($item['route'])) {
                        // Cek apakah route saat ini match dengan prefix menu
                        // Contoh: "admin.products" akan match "admin.products.*"
                        $isActive = request()->routeIs($item['route'] . '*');
                    }
                @endphp

                <a href="{{ $item['href'] }}"
                   class="nav-item {{ $isActive ? 'active' : '' }}"
                   style="{{ !empty($item['danger']) ? 'color: var(--red);' : '' }}">
                    <i class="ti {{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                    @if(!empty($item['badge']))
                        <span class="nav-badge">{{ $item['badge'] }}</span>
                    @endif
                </a>
            @endforeach
        @endforeach

        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit"
                    class="nav-item"
                    style="width: 100%; text-align: left; color: var(--red); cursor: pointer; background: none; border: none; font-family: inherit; font-size: inherit;">
                <i class="ti ti-logout"></i>
                <span>Logout</span>
            </button>
        </form>
    </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
