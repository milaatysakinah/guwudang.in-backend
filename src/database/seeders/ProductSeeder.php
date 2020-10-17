<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id_product_type' => 1,
            'id_user' => 1,
            'product_name' => 'Baju Badut',
            'price' => 200000,
            'units' => "Kg",
        ]);
    }
}
