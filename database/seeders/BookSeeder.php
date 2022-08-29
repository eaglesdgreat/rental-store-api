<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->delete();
        DB::table('books')->insert(array(
            0 =>
            array(
                'id' => 1,
                'title' => 'Make me laugh',
                'description' => 'This book teach you about an happy life',
                'author' => 'Davis Eagles',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'id' => 2,
                'title' => 'Laravel Up and Running',
                'description' => 'This book teach you the basics of laravel framework.',
                'author' => 'Davis Eagles',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'id' => 3,
                'title' => 'PHP for beginners',
                'description' => 'This book teach you the basics of PHP language.',
                'author' => 'Davis Eagles',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'id' => 4,
                'title' => 'JavaScript for beginners',
                'description' => 'This book teach you the basics of JavaScript language.',
                'author' => 'Davis Eagles',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'id' => 5,
                'title' => 'ReactJS for beginners',
                'description' => 'This book teach you the basics of ReactJS language.',
                'author' => 'Davis Eagles',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
