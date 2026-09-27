<section class="lg:my-14 my-8">
    <div class="container">
        <div class="flex flex-wrap">
            <div class="w-full mb-6">
                <h2 class="text-lg">Popular Products</h2>
            </div>
        </div>

        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:gap-4 xl:grid-cols-5">

            @include('customer.partials.product-card', [
                'badge' => 'Sale',
                'badgeClass' => 'bg-red-600 text-white',
                'image' => 'customer/images/products/product-img-1.jpg',
                'category' => 'Snack & Munchies',
                'title' => "Haldiram's Sev Bhujia",
                'rating' => '4.5',
                'reviews' => '149',
                'price' => '$18',
                'oldPrice' => '$24'
            ])

            @include('customer.partials.product-card', [
                'badge' => '14%',
                'badgeClass' => 'bg-green-600 text-white',
                'image' => 'customer/images/products/product-img-2.jpg',
                'category' => 'Bakery & Biscuits',
                'title' => 'NutriChoice Digestive',
                'rating' => '4.5',
                'reviews' => '25',
                'price' => '$24'
            ])

            @include('customer.partials.product-card', [
                'image' => 'customer/images/products/product-img-3.jpg',
                'category' => 'Bakery & Biscuits',
                'title' => 'Cadbury 5 Star Chocolate',
                'rating' => '5',
                'reviews' => '469',
                'price' => '$32',
                'oldPrice' => '$35'
            ])

            @include('customer.partials.product-card', [
                'badge' => 'Hot',
                'badgeClass' => 'bg-red-600 text-white',
                'image' => 'customer/images/products/product-img-4.jpg',
                'category' => 'Snack & Munchies',
                'title' => 'Onion Flavour Potato',
                'rating' => '3.5',
                'reviews' => '456',
                'price' => '$3',
                'oldPrice' => '$5'
            ])

            @include('customer.partials.product-card', [
                'image' => 'customer/images/products/product-img-5.jpg',
                'category' => 'Instant Food',
                'title' => 'Salted Instant Popcorn',
                'rating' => '4.5',
                'reviews' => '39',
                'price' => '$13',
                'oldPrice' => '$18'
            ])

            @include('customer.partials.product-card', [
                'badge' => 'Sale',
                'badgeClass' => 'bg-red-600 text-white',
                'image' => 'customer/images/products/product-img-6.jpg',
                'category' => 'Dairy, Bread & Eggs',
                'title' => 'Blueberry Greek Yogurt',
                'rating' => '4.5',
                'reviews' => '120',
                'price' => '$12',
                'oldPrice' => '$15'
            ])

        </div>
    </div>
</section>
