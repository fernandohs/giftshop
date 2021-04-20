<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
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
                'name'=>'computer',
                'description' => 'electronic device',
            ],
            [
                'name'=>'cellphone',
                'description' => 'smartphone',
            ],
        ];
        DB::table('categories')->insert($seeds);
    }
}
