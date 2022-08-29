<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RentedLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rents')->delete();

        for ($i = 1; $i <= 1000; $i++) {
            $date_value = mt_rand(1262304000,1661904000);
            $num = rand(-10, 10);

            DB::table('rents')->insert(
                [
                    'user_id' => rand(1, 5),
                    'book_id' => ($i % 2 == 0) ? rand(1, 5) : null,
                    'equipment_id' => ($i % 2 != 0) ? rand(1, 5) : null,
                    'rented_date' =>  date('Y-m-d H:i:s', $date_value),
                    'date_to_be_returned' =>  date('Y-m-d H:i:s', $date_value),
                    'date_returned' =>  ($num > 0) ? date('Y-m-d H:i:s', $date_value ) : null,
                    'is_returned' => ($num > 0) ? true : false,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
