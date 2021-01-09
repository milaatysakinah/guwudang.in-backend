<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('product_types')->truncate();
        DB::table('product_types')->insert(['product_type_name' => 'Fashion', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Electronic', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Foods and Drinks', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Beauty and Care', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Health', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Home and Decor', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'Accecoris', 'created_at' => Carbon::now(),]);
    }
}
