<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('transaction_types')->truncate();
        DB::table('transaction_types')->insert(['transaction_name' => 'in', 'created_at' => Carbon::now(), ]);
        DB::table('transaction_types')->insert(['transaction_name' => 'out', 'created_at' => Carbon::now(), ]);
        
    }
}
