<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('units')->insert(['units_name' => 'Kg', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Gram', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Units', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Lusin', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Box', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Lembar', 'created_at' => Carbon::now(),]);
        DB::table('units')->insert(['units_name' => 'Pack', 'created_at' => Carbon::now(),]);
    }
}
