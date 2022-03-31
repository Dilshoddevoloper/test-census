<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => '1', 'name' => 'operator', 'display_name' => 'Оператор', 'description' => 'Оператор'],
            ['id' => '2', 'name' => 'region', 'display_name' => 'Ҳудуд', 'description' => 'Region'],
            ['id' => '3', 'name' => 'city', 'display_name' => 'Туман', 'description' => 'City']
        ];

        DB::table('roles')->insert($roles);
    }
}
