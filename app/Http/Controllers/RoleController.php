<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use App\Role;
use App\Permission;
use App\RolePermission;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : role listing view page
    //==========================================================

     public function index()
    {

        $permission = \App\RolePermission::where('role',Auth::user()->role)->first();
        $sub_permission= ($permission->sub_permissions)? json_decode($permission->sub_permissions,true) :  null;

        $count = 0;
         if( !empty($permission) )
        {
           
            foreach(@$permission->permission as $permissions){
                if(@$permissions == "user-management"){
                    $count ++;
                      return view('role.index');
                }/*else{
            
                    return view('auth.login');
                }*/

            }

        }
        if($count == 0){
             return abort(404);
        }
       
    }

     //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  role create view page
    //==========================================================

    public function create()
    {
        return view('role.create');
    }

      public function store(Request $request)
    {

        $validate = Validator::make($request->all(),
            [
             'name' => 'required',

        ]);
        if ($validate->fails()) {
             return Redirect::back()->withErrors($validate);
            /*return response()->json([
                        'error' => $validate->errors()->all()
                    ]);*/

        }


        Role::create($request->all());

      /*  return response()->json([
                        'success' => 'Role created successfully.'
                    ]);*/
                     return redirect()->route('roles.index')

                    ->with('success','Role Added successfully.');

    }

     //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  roles data from db 
    //==========================================================

      // Fetch records
    public function getRoles(Request $request){
            $name = $request->name;

            ## Read value
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length"); // Rows display per page

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index
            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc
            $searchValue = $search_arr['value']; // Search value


            if($request->delete_ctm =='1'){

                $totalRecord = Role::where('deleted_at','!=',null);

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Role::where('deleted_at','!=',null);



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Role::where('deleted_at','!=',null)->orderBy($columnName,$columnSortOrder);

                $records = $items->skip($start)->take($rowperpage)->get();
            }else{

                // Total records
                $totalRecord = Role::where('deleted_at',null);
                if($name != ""){
                    $totalRecord->where('name','like',"%".$name."%");
                }
                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Role::where('deleted_at',null);

                if($name != ""){
                    $totalRecordswithFilte->where('name','like',"%".$name."%");
                }
                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Role::where('deleted_at',null)->orderBy($columnName,$columnSortOrder);
                if($name != ""){
                    $items->where('name','like',"%".$name."%");
                }

                $records = $items->skip($start)->take($rowperpage)->get();
            }



            $data_arr = array();

            foreach($records as $record){
                $id = $record->id;
                $name = $record->name;

               $data_arr[] = array(
                   "id" => $id,
                   "name" => $name,

                   "edit" => '<div class="settings-main-icon"><a  href="' . url('roles/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a>&nbsp;&nbsp;<a href="' . url('roles/'.$name.'/editPermission') . '"><button class="btn-btn-primary">Permission</button></a></div>'

               );
            }

            $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );

            return response()->json($response);
    }

    //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  role delete function
    //==========================================================

    public function destroy($id)
    {
        $data= Role::find($id)->delete();

        return response()->json([
                        'success' => 'Role Deleted successfully.'
                    ]);

        //return redirect()->route('patients.index')
                        //->with('success','Patient deleted successfully');
    }

    //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  role edit view page
    //==========================================================

       public function edit( $id)
    {
        $data=Role::find($id);
        return view('role.edit',compact('data'));
    }

    //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  role update data function 
    //==========================================================

     public function update(Request $request, $id)
    {

         $validate = Validator::make($request->all(),
            [
             'name' => 'required',

        ]);
        if ($validate->fails()) {
           return Redirect::back()->withErrors($validate);
        }

        $book=Role::findOrFail($id);
        $book->update($request->all());
          return redirect()->route('roles.index')

                    ->with('success','Role Updated successfully.');
    }

     //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  role edit for permission view page
    //==========================================================

     public function editPermission( $id)
    {
        $role_name = $id;
        $totalRecord = Permission::where('deleted_at',null)->get();
        $role = \Auth::user()->role;
        $checked = RolePermission::where('role',$role_name)->first();
  return view('role.editpermission',compact('totalRecord','role_name','checked'));

    }

     //==========================================================
    // Filename: RoleController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  add permission for each role
    //==========================================================
    public function addPermission(Request $request, $id)
    {

        $validate = Validator::make($request->all(),
        [
         'permission' => 'required',

         ]);
        if ($validate->fails()) {
            /*return response()->json([
                        'error' => $validate->errors()->all()
                    ]);*/
                     return Redirect::back()->withErrors($validate);

        }
        $sub="";
        if($request->sub_permission) {
            $content = $request->sub_permission;
            $content = array_values($content);
            $sub = ($content)? json_encode($content): null;
        }
        $data =$request->all();
        $book=RolePermission::where('role',$id)->first();
        if($book == null){
            RolePermission::create([
                'role' => $id,
                'permission' => $data['permission'],
                'sub_permissions' =>$sub
            ]);
             return redirect()->route('roles.index')

                    ->with('success','Permission added successfully');
           /* dd("kk");
            return response()->json([
                            'success' => 'Permission added successfully.'
                        ]);*/

        }
       else{
        $book->update([
            'role' => $id,
            'permission' => $data['permission'],
            'sub_permissions' =>$sub
        ]);
        /*return response()->json([
                        'success' => 'Permission added successfully.'
                    ]);*/
                    return redirect()->route('roles.index')

                    ->with('success','Permission added successfully');
       }

    }












}
