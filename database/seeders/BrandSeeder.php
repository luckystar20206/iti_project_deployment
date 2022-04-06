<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['name' => 'Nike'],
            ['name' => 'Adidas'],
            ['name' => 'Puma'],
            ['name' => 'Zara'],
            ['name' => 'Deisel'],
            ['name' => 'Prada'],
            ['name' => 'Ralph'],
            ['name' => 'Ur'],
            ['name' => 'HM'],
            ['name' => 'Armani'],
        ];
        DB::table('brands')->insert($brands);
    }
}
