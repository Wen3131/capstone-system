<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Vermicast',
            'other_name' => null,
            'category' => '3',
            'amount' => '20',
            'kilos' => '8',
        ]);

        Product::create([
            'name' => 'Saba Banana',
            'other_name' => null,
            'category' => '1',
            'amount' => '75',
            'kilos' => '2',
        ]);

        Product::create([
            'name' => 'Eggplant',
            'other_name' => 'Talong',
            'category' => '1',
            'amount' => '25',
            'kilos' => '10',
        ]);

        Product::create([
            'name' => 'Sweet Potato',
            'other_name' => 'Kamote',
            'category' => '2',
            'amount' => '20',
            'kilos' => '5',
        ]);

        Product::create([
            'name' => 'Malabar Spinach',
            'other_name' => 'Alugbati',
            'category' => '2',
            'amount' => '20',
            'kilos' => '16',
        ]);

        Product::create([
            'name' => 'Cucumber',
            'other_name' => 'Pipino',
            'category' => '1',
            'amount' => '70',
            'kilos' => '5',
        ]);

        Product::create([
            'name' => 'Green Bean',
            'other_name' => 'Sitaw',
            'category' => '2',
            'amount' => '30',
            'kilos' => '4',
        ]);

        Product::create([
            'name' => 'Pineapple',
            'other_name' => 'Pinya',
            'category' => '1',
            'amount' => '50',
            'kilos' => '3',
        ]);
    }
}
