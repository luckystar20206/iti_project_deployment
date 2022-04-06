<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'men'],
            ['name' => 'women'],
            ['name' => 'kids'],
            ['name' => 'jeans'],
            ['name' => 'dress'],
            ['name' => 't-shirts'],
            ['name' => 'long sleeves'],
            ['name' => 'short sleeves'],
            ['name' => 'coats'],
            ['name' => 'uni-sex'],
        ];

        DB::table('categories')->insert($categories);
    }
}
