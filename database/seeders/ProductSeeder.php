<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Internet 50Mbps',
                'hpp' => 250000,
                'margin' => 20, // 20%
            ],
            [
                'name' => 'Internet 100Mbps',
                'hpp' => 400000,
                'margin' => 25, // 25%
            ],
            [
                'name' => 'IP Public Static',
                'hpp' => 150000,
                'margin' => 50, // 50%
            ],
            [
                'name' => 'Router AX3000',
                'hpp' => 850000,
                'margin' => 15, // 15%
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
