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
        DB::table('product_types')->insert(['product_type_name' => 'fashion', 'created_at' => Carbon::now(),]);
        DB::table('product_types')->insert(['product_type_name' => 'electronic', 'created_at' => Carbon::now(),]);
    }
}
