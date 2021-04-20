<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
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
                'url_image' => 'https://picsum.photos/id/0/367/267',
                'price' => rand(10,100),
                'stock' => rand(2,25)
            ],
            [
                'name'=>'macbook',
                'description' => 'notebook of mac',
                'url_image' => 'https://picsum.photos/id/119/367/267',
                'price' => rand(10,100),
                'stock' => rand(2,25)
            ],
        ];
        DB::table('products')->insert($seeds);
    }
}
