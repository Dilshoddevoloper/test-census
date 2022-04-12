<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class ApplicationDenyReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            ['name' => 'Фуқаро бошқа ҳудудга тегишли'],
            ['name' => 'Малумотлар хато киритилган'],
            ['name' => 'Фуқаро аввал ёрдам олган'],
        ];
        foreach ($reasons as $item) {
            \App\Models\ApplicationDenyReason::create($item);
        }
    }
}
