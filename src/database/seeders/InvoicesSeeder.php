<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('invoices')->insert([
            'partner_id' => 1,
            'user_id' => 1,
            'status_invoice_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('invoices')->insert([
            'partner_id' => 2,
            'user_id' => 1,
            'status_invoice_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
