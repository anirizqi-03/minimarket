<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {

        $produkByKategori = [
            'Makanan' => [
                ['Beras Premium 5kg', 65000, 75000],
                ['Beras Medium 5kg', 55000, 62000],
                ['Minyak Goreng 2L', 32000, 38000],
                ['Mie Instan Goreng', 2500, 3500],
                ['Mie Instan Kuah', 2500, 3500],
                ['Telur Ayam 1kg', 25000, 30000],
                ['Gula Pasir 1kg', 14000, 17000],
                ['Tepung Terigu 1kg', 11000, 14000],
                ['Sarden Kaleng', 12000, 15000],
                ['Kornet Sapi', 18000, 22000],
            ],
            'Minuman' => [
                ['Air Mineral 600ml', 2500, 3500],
                ['Air Mineral 1.5L', 4500, 6000],
                ['Teh Kotak 1L', 9000, 12000],
                ['Kopi Sachet', 1500, 2500],
                ['Susu UHT 1L', 16000, 20000],
                ['Susu Kental Manis', 10000, 13000],
                ['Sirup Marjan', 18000, 23000],
                ['Minuman Soda 390ml', 4000, 5500],
                ['Jus Buah Kotak', 6000, 8000],
                ['Minuman Isotonik 500ml', 5000, 7000],
            ],
            'Snack' => [
                ['Biskuit Cokelat', 11000, 15000],
                ['Keripik Kentang', 8000, 12000],
                ['Wafer Vanilla', 7000, 10000],
                ['Kacang Atom', 5000, 7000],
                ['Permen Mint', 3000, 5000],
                ['Cokelat Batang', 8000, 12000],
                ['Roti Tawar', 10000, 14000],
                ['Roti Sobek', 12000, 16000],
                ['Kue Kering', 15000, 22000],
                ['Kripik Singkong', 6000, 9000],
            ],
            'Kebutuhan Rumah' => [
                ['Sabun Mandi Batang', 3500, 5000],
                ['Sabun Cair 500ml', 15000, 20000],
                ['Shampo 340ml', 22000, 28000],
                ['Pasta Gigi 190g', 12000, 18000],
                ['Sikat Gigi', 5000, 8000],
                ['Deterjen Bubuk 1kg', 18000, 23000],
                ['Deterjen Cair 800ml', 20000, 25000],
                ['Pembersih Lantai 800ml', 12000, 16000],
                ['Tissue Gulung 4pcs', 10000, 14000],
                ['Tissue Kotak 250s', 8000, 11000],
            ],
            'Perawatan Diri' => [
                ['Deodorant Roll On', 15000, 20000],
                ['Sabun Cuci Muka', 18000, 25000],
                ['Hand Sanitizer 100ml', 10000, 15000],
                ['Body Lotion 200ml', 22000, 30000],
                ['Minyak Rambut', 8000, 12000],
                ['Pasta Gigi Anak', 9000, 13000],
                ['Sikat Gigi Anak', 4000, 7000],
                ['Razor Cukur', 6000, 9000],
                ['Krim Pelembab', 20000, 28000],
                ['Parfum 50ml', 35000, 50000],
            ],
            'Sayuran & Buah' => [
                ['Apel Merah 1kg', 28000, 35000],
                ['Apel Hijau 1kg', 30000, 38000],
                ['Jeruk Mandarin 1kg', 25000, 32000],
                ['Pisang Cavendish 1kg', 18000, 24000],
                ['Anggur Merah 500g', 35000, 45000],
                ['Wortel 500g', 8000, 12000],
                ['Kentang 1kg', 14000, 18000],
                ['Tomat 500g', 6000, 9000],
                ['Brokoli 500g', 15000, 20000],
                ['Bayam 1ikat', 3000, 5000],
            ],
        ];

        $kategori = $this->faker->randomElement(array_keys($produkByKategori));
        $produk   = $this->faker->randomElement($produkByKategori[$kategori]);

        [$nama, $hargaBeli, $hargaJual] = $produk;

        return [
            'name'        => $nama,
            'category'    => $kategori,
            'description' => $this->faker->sentence(10),
            'price'       => $hargaJual,
            'stock'       => $this->faker->numberBetween(0, 500),
            'image'       => null,
            'is_active'   => $this->faker->boolean(90), // 90% aktif
        ];
    }

    /**
     * State: produk dengan stok habis
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }

    /**
     * State: produk dengan stok menipis
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => $this->faker->numberBetween(1, 10),
        ]);
    }

    /**
     * State: produk nonaktif
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * State: produk untuk kategori tertentu
     */
    public function kategori(string $kategori): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $kategori,
        ]);
    }
}
