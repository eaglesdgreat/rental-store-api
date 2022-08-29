<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'first_name' => 'John',
                'email' => 'johndoe@example.com',
                'last_name' => 'Doe',
                'user_name' => 'johnny',
                'phone_number' => '09089987887',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'id' => 2,
                'first_name' => 'John',
                'email' => 'johnsnow@example.com',
                'last_name' => 'Snow',
                'user_name' => 'sjohn',
                'phone_number' => '09089987855',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'id' => 3,
                'first_name' => 'Micheal',
                'email' => 'micdan@example.com',
                'last_name' => 'Dan',
                'user_name' => 'danny',
                'phone_number' => '09089337855',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'id' => 4,
                'first_name' => 'Uche',
                'email' => 'uc@example.com',
                'last_name' => 'Chukwu',
                'user_name' => 'che',
                'phone_number' => '09089912855',
                'created_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'id' => 5,
                'first_name' => 'Segun',
                'email' => 'segez@example.com',
                'last_name' => 'Emmanuel',
                'user_name' => 'Emmy',
                'phone_number' => '09040987855',
                'created_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
