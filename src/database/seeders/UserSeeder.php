<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'kucing1@gmail.com',
            'username' => 'kucing1',
            'profile_picture' => '',
            'password' => 'kucing1',
        ]);
        
    }
}
