<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCart = [
        ['product_id' => 1, 'cart_id' => 1, 'product_quantity' => 1],
        ['product_id' => 2, 'cart_id' => 2, 'product_quantity' => 2],
        ['product_id' => 3, 'cart_id' => 3, 'product_quantity' => 3],
        ['product_id' => 4, 'cart_id' => 4, 'product_quantity' => 4],
        ['product_id' => 5, 'cart_id' => 5, 'product_quantity' => 5],
        ['product_id' => 6, 'cart_id' => 6, 'product_quantity' => 6],
        ['product_id' => 7, 'cart_id' => 7, 'product_quantity' => 7],
        ['product_id' => 8, 'cart_id' => 8, 'product_quantity' => 8],
        ['product_id' => 9, 'cart_id' => 9, 'product_quantity' => 9],
        ['product_id' => 10, 'cart_id' => 10, 'product_quantity' =>  10],

        ];

        DB::table('cart_products')->insert($productCart);
    }
}
