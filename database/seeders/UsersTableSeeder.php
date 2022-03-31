<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => '1','role_id' => '1','region_id' => null,   'city_id' => null, 'login'=> 'operator1','name' => 'Operator', 'password'  => bcrypt('123456789')],
            ['id' => '2','role_id' => '1','region_id' => null ,  'city_id' => null,'login'=> 'operator2','name' => 'Operator', 'password'  => bcrypt('123456789')],
            ['id' => '3','role_id' => '2','region_id' => '11', 'city_id' => null,'login'=> 'region1','name' => 'Navoiy Viloyat hokimi', 'password'  => bcrypt('123456789')],
            ['id' => '4','role_id' => '2','region_id' => '22', 'city_id' => null, 'login'=> 'region2','name' => 'Toshkent shahar hokimi', 'password'  => bcrypt('123456789')],
            ['id' => '5','role_id' => '3','region_id' => '11', 'city_id' => '60', 'login'=> 'city1','name' => 'Qiziltepa tumani hokimi', 'password'  => bcrypt('123456789')],
            ['id' => '6','role_id' => '3','region_id' => '22', 'city_id' => '204', 'login'=> 'city2','name' => 'Chilonzor tumani hokimi ', 'password'  => bcrypt('123456789')],
        ];
        DB::table('users')->insert($users);
    }
}
