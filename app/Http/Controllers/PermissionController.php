<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;
use Illuminate\Support\Facades\Validator;
use Auth;


class PermissionController extends Controller
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
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission listing view page
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
                     return view('permission.index');
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
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission create view page
    //==========================================================
    public function create()
    {
        return view('permission.create');
    }

    //==========================================================
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission data store function 
    //==========================================================
    public function store(Request $request)
    {



        $rules = array(
            'name' => 'required|unique:permissions',
        );
        $messages = array(
                        'name.unique:permissions' => 'Permission already exists.'
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() )
        {
            return [
                'success' => "Permission already exists",
                'message' => $validator->errors()->all()
            ];
        }



        Permission::create($request->all());

        return response()->json([
                        'success' => 'Permission created successfully.'
                    ]);

    }

     //==========================================================
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission data from db 
    //==========================================================
      // Fetch records
    public function getPermissions(Request $request){
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

                $totalRecord = Permission::where('deleted_at','!=',null);

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Permission::where('deleted_at','!=',null);



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Permission::where('deleted_at','!=',null)->orderBy($columnName,$columnSortOrder);

                $records = $items->skip($start)->take($rowperpage)->get();
            }else{

                // Total records
                $totalRecord = Permission::where('deleted_at',null);
                if($name != ""){
                    $totalRecord->where('name','like',"%".$name."%");
                }
                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Permission::where('deleted_at',null);

                if($name != ""){
                    $totalRecordswithFilte->where('name','like',"%".$name."%");
                }
                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Permission::where('deleted_at',null)->orderBy($columnName,$columnSortOrder);
                if($name != ""){
                    $items->where('name','like',"%".$name."%");
                }

                $records = $items->skip($start)->take($rowperpage)->get();
            }
            $data_arr = array();

            foreach($records as $record){
                $id = $record->id;
                $name = $record->name;
                $content = ($record->sub_permission)? json_decode($record->sub_permission,true) :  null;
               $data_arr[] = array(
                   "id" => $id,
                   "name" => $name,
                   "edit" =>$content

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
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission delete function
    //==========================================================
    public function destroy($id)
    {
        $data= Permission::find($id)->delete();

        return response()->json([
                        'success' => 'Permission Deleted successfully.'
                    ]);

        //return redirect()->route('patients.index')
                        //->with('success','Patient deleted successfully');
    }

    //==========================================================
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission edit view page
    //==========================================================

       public function edit( $id)
    {
        $data=Permission::find($id);
        return view('permission.edit',compact('data'));
    }

    //==========================================================
    // Filename: PermissionController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  permission update data function 
    //==========================================================

     public function update(Request $request, $id)
    {

         $validate = Validator::make($request->all(),
            [
             'name' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                        'error' => $validate->errors()->all()
                    ]);
        }



        $book=Permission::findOrFail($id);

        $book->update($request->all());


         return response()->json([
                        'success' => 'Permission updated successfully.'
                    ]);
    }











}
