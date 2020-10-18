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
        DB::table('partner')->insert([
            'user_id' => 1,
            'name' => 'Kambing',
            'email' => 'kambing@gmail.com',
            'address' => 'Jl. Pahlawan 14',
            'phone_number' => '0888888888',
            'created_at' => Carbon::now(),
        ]);

        DB::table('partner')->insert([
            'user_id' => 2,
            'name' => 'Sakinah',
            'email' => 'sakinah@gmail.com',
            'address' => 'Jl. ITS 14',
            'phone_number' => '088888777',
            'created_at' => Carbon::now(),
        ]);
    }
}
