<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserroleSeeder extends Seeder
{
    public function run()
    {
        DB::table('userroles')->insert([
            'user_id' => '1',
            'admin' => '3',
            'asset' => '2',
            'hris' => '2',
            'maintenance' => '2',
            'room' => '2',
        ]);
    }
}
