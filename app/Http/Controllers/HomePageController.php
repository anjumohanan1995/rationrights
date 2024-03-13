<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\RolePermission;
use App\Permission;


class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $roles = [

        //     'Civil Supplies Admin',

        //     'Civil Supplies Access Control User',

        //     'Civil Supplies District User',

        //     'Civil Supplies Taluk User',

        //     'State UT User',

        //     'DGP',

        //     'District Chief',

        //     'Labour Commissioner',

        //     'District Labour Officer',

        //     'Secretariat Staff',

        //     'Minister Office Staff',

        //     'Central Govt Staff'

        //  ];



        //  foreach ($roles as $role) {

        //     Role::create(['name' => $role]);

        //  }


        //  User::create([
        //      'name' => 'Admin New',
        //      'email' => 'admin@gmail.com',
        //      'role' => 'Admin',
        //      'password' => Hash::make('12345678')
        //  ]);
        // $permissions = [
        //     [
        //         'role' => 'Admin',
        //         'sub_permissions' => json_encode(["users", "add-role", "permission"]),
        //         'permission' => array('user-management'),
        //     ],
        // ];
    
        // RolePermission::truncate();
    
        // foreach ($permissions as $val) {
        //     RolePermission::create($val);
        // }

        // $permissions = [
        //     [
        //         'name' => 'user-management',
        //         'sub_permission' => json_encode(["users", "add-role", "permission"])
        //     ],
        //     [
        //         'name' => 'Applications List',
        //         'sub_permission' => json_encode(["Adhar and ration card", "Adhar only", "No adhar and ration card"])
        //     ],
        //     [
        //         'name' => 'Application Forms'
        //     ]
        // ];
    
        // Permission::truncate();
    
        // foreach ($permissions as $val) {
        //     Permission::create($val);
        // }


        return view('home.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
