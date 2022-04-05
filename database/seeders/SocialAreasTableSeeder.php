<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social_areas = [
            ['id' => 1, 'name_cyrl' => 'Кам таъминланган оила фарзанди (ИҲЯР)'],
            ['id' => 2, 'name_cyrl' => 'Aжрим ёқасида'],
            ['id' => 3, 'name_cyrl' => 'Нотинч оиладаги аёл'],
            ['id' => 4, 'name_cyrl' => 'Ногиронлиги бор'],
            ['id' => 5, 'name_cyrl' => 'Ногирон фарзанд тарбиялаётган'],
            ['id' => 6, 'name_cyrl' => 'Ҳарбий хизматдан қайтган лекин ишга жойлаша олмаган шахс'],
            ['id' => 7, 'name_cyrl' => 'Етимлик (чин, ярим, ижтимоий) тоифасидан бирига киради'],
            ['id' => 8, 'name_cyrl' => 'Жазони ижро этиш муассасасидан қайтган шахс'],
            ['id' => 9, 'name_cyrl' => 'Оилавий зўравонлик қурбони бўлган аёл'],
            ['id' => 10, 'name_cyrl' => 'Уй-жойга эҳтиёжи бор'],
            ['id' => 11, 'name_cyrl' => 'Ижтимоий кўмак кўрсатилганлар'],
            ['id' => 12, 'name_cyrl' => 'Ижтимоий фаол ёшлар'],
            ['id' => 13, 'name_cyrl' => 'Нафақа олувчилар'],
            ['id' => 14, 'name_cyrl' => 'Бошпанасиз ёшлар'],
            ['id' => 15, 'name_cyrl' => 'Алоҳида назоратда турувчи ёшлар'],
            ['id' => 16, 'name_cyrl' => 'Боқувчисини йўқотганлар'],
            ['id' => 17, 'name_cyrl' => 'Миграциядан қайтганлар'],
            ['id' => 18, 'name_cyrl' => 'Темир дафтардаги оила фарзандлари'],
        ];
        DB::table('social_areas')->insert($social_areas);
    }
}
