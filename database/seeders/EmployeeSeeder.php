<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        DB::table('employees')->insert([
            'user_id'  => '1',
            'name' => 'Bijey Syenna Lovika Boby',
            'gender' => 'Laki-laki',
            'npwp' => '75.937.878.9-331.000',
            'nik' => '1673061207950004',
            'religion' => 'Islam',
            'bornplace' => 'Lubuklinggau',
            'borndate' => '2023-03-22',
            'address' => 'Thehok, Jambi',
            'phone' => '082307761670',
            'status_perkawinan' => 'kawin',
            'joindate' => '01-06-2021',
            'nip' => '0023',
            'email' => 'masbijey@gmail.com'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Information Technology'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Human and Resource'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Sales and Marketing'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Accounting'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Housekeeping'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Engineering'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Front Office'
        ]);

        DB::table('departments')->insert([
            'name'  => 'FB Service'
        ]);

        DB::table('departments')->insert([
            'name'  => 'FB Kitchen'
        ]);

        DB::table('assetcats')->insert([
            'name'  => 'IT - Hardware'
        ]);

        DB::table('assetcats')->insert([
            'name'  => 'IT - Software'
        ]);
    }
}
