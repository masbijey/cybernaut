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
            'name'  => 'Bijey Syenna',
            'email' =>  'masbijey@gmail.com',
            'password'  => bcrypt('84n73ng123**')
        ]);
    }
}
