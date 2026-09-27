<!doctype html>
<html lang="id">

<head>
    @include('admin.partials.head')
</head>

<body>
    <div class="app-shell">
        @include('admin.partials.sidebar')   {{-- ← class .sidebar --}}

        <div class="app-main">
            @include('admin.partials.topbar')   {{-- ← class .topbar --}}

            <main class="app-content">
                @yield('content')
            </main>

            @include('admin.partials.footer')
        </div>
    </div>

    @include('admin.partials.modal')
    @include('admin.partials.scripts')
    @stack('scripts')
</body>

</html>
