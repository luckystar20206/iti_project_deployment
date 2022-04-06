<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cart = [
            ['user_id' => 1],
            ['user_id' => 2],
            ['user_id' => 3],
            ['user_id' => 4],
            ['user_id' => 5],
            ['user_id' => 6],
            ['user_id' => 7],
            ['user_id' => 8],
            ['user_id' => 9],
            ['user_id' => 10],
        ];

        DB::table('carts')->insert($cart);
    }
}
