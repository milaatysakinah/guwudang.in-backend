<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusInvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        //DB::table('status_invoices')->truncate();
        DB::table('status_invoices')->insert(['status' => 'belum dikirim', 'created_at' => Carbon::now(),]);
        DB::table('status_invoices')->insert(['status' => 'sedang dikirim', 'created_at' => Carbon::now(),]);
        DB::table('status_invoices')->insert(['status' => 'sudah dikirim', 'created_at' => Carbon::now(),]);
    }
}
