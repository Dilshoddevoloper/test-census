<?php

namespace Database\Seeders;

use App\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class CitizensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\User');
        $cities = City::all();

        foreach ($cities as $city)
        {
            $number = mt_rand(50,100);
            for ($int= 0; $int < $number; $int++){
            $letter = chr(rand(65,90));
            $pass = chr(rand(65,90));
            $pass_number = mt_rand(1000000,9999999);
            $tin =  mt_rand(10000000000000,99999999999999);
            $social = mt_rand(1,18);
            DB::table('citizens')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'fathers_name' => $faker->name,
                'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'region_id' => $city->region_id,
                'city_id' => $city->id,
                'address' => $faker->address,
                'social_areas_id' => $social,
                'passport' =>$letter.$pass.$pass_number,
                'tin' => $tin
            ]);
            }

        }
    }
}
