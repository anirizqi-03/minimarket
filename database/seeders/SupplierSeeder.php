<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name'    => 'PT. Indofood Sukses Makmur Tbk',
                'phone'   => '081234567890',
                'address' => 'Jl. Sudirman No. 12, Jakarta Selatan',
            ],
            [
                'name'    => 'PT. Unilever Indonesia Tbk',
                'phone'   => '082198765432',
                'address' => 'BSD Green Office Park, Tangerang',
            ],
            [
                'name'    => 'PT. Mayora Indah Tbk',
                'phone'   => '083811223344',
                'address' => 'Jl. Daan Mogot Km. 18, Jakarta Barat',
            ],
        ];

        foreach ($suppliers as $data) {
            Supplier::create($data);
        }
    }
}
