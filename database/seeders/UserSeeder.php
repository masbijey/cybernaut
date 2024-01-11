<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name'  => 'Bijey Syenna Lovika Boby',
            'email' =>  'masbijey@gmail.com',
            'password'  => bcrypt('84n73ng123**'),
            'joindate' => '01-06-2021',
        ]);
    }
}
