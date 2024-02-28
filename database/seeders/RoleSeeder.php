<?php

namespace Database\Seeders;

use App\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [

            'Civil Supplies Admin',

            'Civil Supplies Access Control User',

            'Civil Supplies District User',

            'Civil Supplies Taluk User',

            'State UT User',

            'DGP',

            'District Chief',

            'Labour Commissioner',

            'District Labour Officer',

            'Secretariat Staff',

            'Minister Office Staff',

            'Central Govt Staff'

         ];



         foreach ($roles as $role) {

            Role::create(['name' => $role]);

         }
    }
}
