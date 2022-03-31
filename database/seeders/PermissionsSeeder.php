<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('permissions')) {

//            citizens permissions

            $parent = Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчи',
                'name' => 'citizens',
            ]);
            Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчи жадвали',
                'name' => 'citizens.index',
                'parent_id' => $parent->id
            ]);
            Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчи яратиш',
                'name' => 'citizens.create',
                'parent_id' => $parent->id
            ]);
            Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчини ўзгартириш',
                'name' => 'citizens.update',
                'parent_id' => $parent->id
            ]);
            Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчини кўриш',
                'name' => 'citizens.show',
                'parent_id' => $parent->id
            ]);
            Permission::firstOrCreate([
                'display_name' => 'Фойдаланувчини ўчириш',
                'name' => 'citizens.delete',
                'parent_id' => $parent->id
            ]);
//            end citizens permissions
    }
}
