<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('partners')->insert([
            'user_id' => 1,
            'name' => 'Kambing',
            'email' => 'kambing@gmail.com',
            'address' => 'Jl. Pahlawan 14',
            'phone_number' => '0888888888',
            'created_at' => Carbon::now(),
        ]);
    }
}
