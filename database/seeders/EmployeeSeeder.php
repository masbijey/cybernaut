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

        DB::table('employees')->insert([
            'user_id'  => '2',
            'name' => 'Yesita Putri',
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

        DB::table('employees')->insert([
            'user_id'  => '3',
            'name' => 'Ananda Gentha',
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

        DB::table('employees')->insert([
            'user_id'  => '4',
            'name' => 'Nia Oktafitri',
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
            'name'  => 'Cybernaut Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Source Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Brand and Business Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Money Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Cleaning Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Fixit Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'Welcome Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'FB Service Unit'
        ]);

        DB::table('departments')->insert([
            'name'  => 'FB Kitchen Unit'
        ]);

        DB::table('assetcats')->insert([
            'name'  => 'IT - Notebook'
        ]);

        DB::table('assetcats')->insert([
            'name'  => 'IT - CPU'
        ]);
    }
}
