<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('locations')->insert([
            'name'  => 'IT - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'IT - Store'
        ]);

        DB::table('locations')->insert([
            'name'  => 'ENG - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'ENG - Store'
        ]);

        DB::table('locations')->insert([
            'name'  => 'HR - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'HK - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'HK - Store'
        ]);

        DB::table('locations')->insert([
            'name'  => 'SM - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'FB - Office'
        ]);

        DB::table('locations')->insert([
            'name'  => 'FB - Kitchen'
        ]);

        DB::table('locations')->insert([
            'name'  => 'FB - Pastry'
        ]);

        DB::table('locations')->insert([
            'name'  => 'Lift - Passenger 1'
        ]);

        DB::table('locations')->insert([
            'name'  => 'Lift - Passenger 2'
        ]);

        DB::table('locations')->insert([
            'name'  => 'Lift - Service'
        ]);
    }
}
