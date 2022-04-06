<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            ['shipping_address' => 'cairo', 'total_cost' => 100, 'user_id' => 1,  'created_at' => Carbon::now()],
            ['shipping_address' => 'alex', 'total_cost' => 200, 'user_id' => 3,  'created_at' => Carbon::now()],
            ['shipping_address' => 'tanta', 'total_cost' => 300, 'user_id' => 5,  'created_at' => Carbon::now()],
            ['shipping_address' => 'florida', 'total_cost' => 400, 'user_id' => 7,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new york', 'total_cost' => 500, 'user_id' => 9,  'created_at' => Carbon::now()],
            ['shipping_address' => 'washonton', 'total_cost' => 600, 'user_id' => 2,  'created_at' => Carbon::now()],
            ['shipping_address' => 'califorina', 'total_cost' => 700, 'user_id' => 4,  'created_at' => Carbon::now()],
            ['shipping_address' => 'london', 'total_cost' => 800, 'user_id' => 6,  'created_at' => Carbon::now()],
            ['shipping_address' => 'boston', 'total_cost' => 900, 'user_id' => 8,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 10,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 11,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 12,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 13,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 14,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 15,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 16,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 17,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 18,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 19,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 20,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 21,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 22,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 23,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 24,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 25,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 26,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 27,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 28,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 29,  'created_at' => Carbon::now()],
            ['shipping_address' => 'new jersey', 'total_cost' => 1000, 'user_id' => 30,  'created_at' => Carbon::now()],

        ];

        DB::table('orders')->insert($orders);
    }
}
