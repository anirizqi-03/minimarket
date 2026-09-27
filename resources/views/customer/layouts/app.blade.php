<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Freshcart Ecommerce')</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.4/dist/tiny-slider.css" />
    @stack('styles')

    @include('customer.partials.head')
</head>
<body>

    {{-- @include('customer.partials.top-navbar') --}}
    @include('customer.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('customer.partials.footer')
    @include('customer.partials.modal-product')

    @include('customer.partials.buy-template')

    @include('customer.partials.scripts')

    @stack('scripts')

</body>
</html>
