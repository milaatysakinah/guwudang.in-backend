<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_items')->insert([
            'invoice_id' => 1,
            'product_id' => 1,
            'transaction_type_id' => 1,
            'transaction_date' => Carbon::now(),
            'order_quantity' => '1',
            'created_at' => Carbon::now(),
        ]);
    }
}
