<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            'address' => 'Meteor St.',
            'phone_number' => '0811111111',
            'company_name' => 'Miero',
            'profile_picture' => 'http://api.guwudangin.me/storage/userpic/default.png',
            'password' => Hash::make('kucing1'),
        ]);
        
    }
}
