<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(StatusInvoicesSeeder::class);
        $this->call(InvoicesSeeder::class);
        $this->call(TransactionTypesSeeder::class);
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderItemsSeeder::class);
        $this->call(ProductDetailsSeeder::class);
    }
}
