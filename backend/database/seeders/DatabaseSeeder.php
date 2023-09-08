<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // USER SEEDER
        $this->call(UserSeeder::class);

        // NEWS SEEDER
        $this->call(NewsSeeder::class);

        // PROGRAM SEEDER
        $this->call(ProgramSeeder::class);

        // RESEARCH SEEDER
        $this->call(ResearchSeeder::class);

        // PRODUCT SEEDER
        $this->call(ProductSeeder::class);

        // CUSTOMER SEEDER
        $this->call(CustomerSeeder::class);

        // ORDER SEEDER
        $this->call(OrderSeeder::class);

        // SALES SEEDER
        $this->call(SalesSeeder::class);
    }
}
