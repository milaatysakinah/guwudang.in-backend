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
            'product_type_id' => 1,
            'user_id' => 1,
            'product_name' => 'Baju Badut',
            'price' => 200000,
            'units' => 3,
            'description' => 'Ini Deskripsi product 1',
            'product_picture' => 'http://api.guwudangin.me/storage/productpic/default.png',
        ]);
    }
}
