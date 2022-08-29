<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipments')->delete();
        DB::table('equipments')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'HP EliteBook',
                'color' => 'gray',
                'type' => 'laptop',
                'condition' => 'good',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'IPhone 11 pro',
                'color' => 'gray',
                'type' => 'mobile device',
                'condition' => 'good',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'MacBook 2019',
                'color' => 'black',
                'type' => 'laptop',
                'condition' => 'average',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Infinix Hot 11',
                'color' => 'black',
                'type' => 'mobile device',
                'condition' => 'average',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Plastic Chair',
                'color' => 'white',
                'type' => 'chair',
                'condition' => 'good',
                'is_rented' => false,
                'created_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
