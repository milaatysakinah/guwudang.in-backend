<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_details')->insert([
            'product_id' => 1,
            'product_quantity' => 2,
            'description' => 'Ini Deskripsi product 1',
            'product_picture' => '/img/',
            'in_date' => Carbon::now(),
            'exp_date' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
