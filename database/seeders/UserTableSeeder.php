<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            [
                'name' => 'administrator',
                'email' => 'admin@mail.com',
                'password' => bcrypt("admin"),
                'birth_date' => '1990-08-11',
                'phone' => '6623667235',
                'city' => 'Hermosillo',
                'state' => 'Sonora',
                'street' => 'Rio de plata',
                'zip_code' => '83175',
                'is_admin' => 1
            ],
        ]);
    }
}
