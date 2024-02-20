<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\RolePermission;

class SubPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermission::truncate();
        $permissions = $this->getPermissions();
        foreach ($permissions as $val) {
            RolePermission::create($val);
        }
    }

    public function getPermissions()
    {
        return [

            [
                'role' => 'Admin',
                'sub_permissions' => json_encode(["users","add-role","permission"]),
                'permission'=>array('user-management'),

            ],


        ];
    }
}
