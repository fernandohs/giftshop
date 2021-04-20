<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $seeds = [
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Processing',
            ],
            [
                'name' => 'Rejected',
            ],
            [
                'name' => 'Completed',
            ],

        ];
        DB::table('sales_status')->insert($seeds);
    }
}
