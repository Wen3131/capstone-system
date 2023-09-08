<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sales::create([
            'order_id' => '1',
            'product_id' => '6',
            'kilos' => '2',
        ]);

        Sales::create([
            'order_id' => '1',
            'product_id' => '3',
            'kilos' => '3',
        ]);

        Sales::create([
            'order_id' => '2',
            'product_id' => '4',
            'kilos' => '2',
        ]);

        Sales::create([
            'order_id' => '2',
            'product_id' => '8',
            'kilos' => '1',
        ]);

        Sales::create([
            'order_id' => '3',
            'product_id' => '6',
            'kilos' => '3',
        ]);

        Sales::create([
            'order_id' => '3',
            'product_id' => '8',
            'kilos' => '2',
        ]);
    }
}
