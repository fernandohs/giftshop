<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds =[
            [
                'category_id' => 1,
                'product_id' => 1
            ],
            [
                'category_id' => 1,
                'product_id' => 2
            ],
        ];
        DB::table('categories_products')->insert($seeds);
    }
}
