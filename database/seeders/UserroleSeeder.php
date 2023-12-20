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
            'signage' => '2',
            'workorder' => '2',
            'task' => '2',
            'asset' => '2',
            'voucher' => '2',
            'beo' => '2',
            'hris' => '2',
            'attendance' => '2',
            'leave' => '2',
            'admin' => '1'
        ]);
    }
}
