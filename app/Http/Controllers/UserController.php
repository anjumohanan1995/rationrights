<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\PreviousUser;
use App\AccessKey;

use App\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Redirect;
use Excel;
use App\Imports\ImportUser;
use App\State;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Auth;




class UserController extends Controller
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
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user listing view page
    //==========================================================
     public function index()
    {

         return view('user.index');

    }

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user create view page
    //==========================================================

    public function create()
    {
        $districts = District::get();
        $role=Role::where('deleted_at' ,null)->get();
        $states=State::where('deleted_at',null)->get();
        return view('user.create',compact('role','states','districts'));

    }

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user data add function
    //==========================================================

      public function store(Request $request)
    {
        /* request()->validate([
            'name' => 'required',
            'mobile' => 'required'

        ]);  */

         $validate = Validator::make($request->all(),
            [
              'name' => 'required',

               'email'=>['required','email',Rule::unique('users','email')->whereNull('deleted_at')],
             // 'email' => 'required|email|unique:users,deleted_at,NULL',

              'password' => 'required' ,
              'role' => 'required' ,
              'state' => 'nullable' ,


           /*  'adhar'=> 'required|min:10'],[

            'adhar.min' => 'Name must have 10 digits.'*/
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withInput()->withErrors($validate);
        }

        if($file = $request->file('image')) {

            $name = uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move('/user', $name);
           // dd($file);

        }else{
            $name = '';
        }
        if(!empty($request->camera_id)){
            $camera_id = $request->camera_id;
        $camera =implode(',', $camera_id);
    }else{
        $camera ='';
    }







        User::create([
            'name' => @$request->name? $request->name:'',


            'email' => @$request->email?$request->email:'',
            'password' => Hash::make($request->password),

            'role' => @$request->role?$request->role:'',
            'state' => @$request->state?$request->state:'',
            'district' => @$request->district?$request->district:'',
            'taluk' => @$request->taluk?$request->taluk:''

        ]);

        return redirect()->route('user-management.index')

                    ->with('success','User Added successfully.');



    }

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user data from db
    //==========================================================


      // Fetch records
    public function getUsers(Request $request){
            $email = $request->email;
            $mobile  =  $request->mobile;
            $location =  $request->location;
            $name =  $request->name;





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

                $totalRecord = User::where('deleted_at','!=',null);

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = User::where('deleted_at','!=',null);



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = User::where('deleted_at','!=',null)->orderBy($columnName,$columnSortOrder);

                $records = $items->skip($start)->take($rowperpage)->get();
            }else{

                // Total records
                $totalRecord = User::where('deleted_at',null)->orderBy('created_at','desc');
                if($mobile != ""){
                    $totalRecord->where('mobile','like',"%".$mobile."%");
                }
                if($email != ""){
                    $totalRecord->where('email','like',"%".$email."%");
                }
                if($location != "" ){
                    //echo "khk";exit;
                    $totalRecord->where('location','like',"%".$location."%");
                }
                if($name != "" ){
                    //echo "khk";exit;
                    $totalRecord->where('name','like',"%".$name."%");
                }

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = User::where('deleted_at',null)->orderBy('created_at','desc');

                if($mobile != ""){
                    $totalRecordswithFilte->where('mobile','like',"%".$mobile."%");
                }
                if($email != ""){
                    $totalRecordswithFilte->where('email','like',"%".$email."%");
                }
                if($location != "" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->where('location', 'like',"%".$location."%");
                }
                if($name != "" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->where('name', 'like',"%".$name."%");
                }


                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = User::where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
                if($mobile != ""){
                    $items->where('mobile','like',"%".$mobile."%");
                }
                if($email != ""){
                    $items->where('email','like',"%".$email."%");
                }
                if($location != "" ){
                    //echo "khk";exit;
                    $items->where('location','like',"%".$location."%");
                }
                if($name != "" ){
                    //echo "khk";exit;
                    $items->where('name','like',"%".$name."%");
                }

                $records = $items->skip($start)->take($rowperpage)->get();
            }



            $data_arr = array();
            $i=$start;
            foreach($records as $record){
                $i++;
                $id = $record->id;
                $name = $record->name;
                $state = @$record->state;

                $email =  $record->email;


                  $role  =  $record->role;
                  if($record->deleted_at != null){
                    $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
                    $change = '';

                  }else{
                    $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
                    $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


                  }
               $data_arr[] = array(
                "sl_no" =>$i,
                   "id" => $id,
                   "name" => $name,

                  "email" => $email,
                  "state"  =>$state,
                   "role" => $role,
                   "edit" => $edit,

                    "change"=>$change

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
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user delete function
    //==========================================================

    public function destroy($id)
    {
        $data= User::find($id)->delete();

        return response()->json([
                        'success' => 'User Deleted successfully.'
                    ]);

        //return redirect()->route('patients.index')
                        //->with('success','Patient deleted successfully');
    }

      //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user edit view page
    //==========================================================

       public function edit( $id)
    {
        $data=User::find($id);
        $role =Role::orderBy('id','desc')->where('deleted_at',null)->get();

        $states=State::where('deleted_at',null)->get();
        $districts = District::get();
        return view('user.edit',compact('data','role','states','districts'));
    }


      //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user update data function
    //==========================================================

     public function update(Request $request, $id)
    {
        //dd("jj");
          $validate = Validator::make($request->all(),
            [
              'name' => 'required',
              'email' => 'required|email|unique:users,deleted_at,NULL'.$id,

              'role' => 'required' ,
              'state' => 'required' ,



        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }

        $book=User::findOrFail($id);

        $data = $request->all();
        if($request->password != ''){
            $data['password'] =  Hash::make($request->password);
        }



        $book->update($data);

         return redirect()->route('user-management.index')

                    ->with('success','User Updated successfully.');


    }

     //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user restore data function
    //==========================================================

    public function userRestore(Request $request, $id)
    {
        $user=User::where('_id',$id)->first();
         $email = $user->email;

         $users=User::where('email',$email)->where('deleted_at',null)->get();
         //dd(count($users));
         if(count($users) >1){
           // dd("if");
            return redirect('user-management')->with('danger','User Email Already Exist');
         }else{
            //dd("else");
             $user->deleted_at = null;
        $user->update();
         return redirect('user-management')->with('success','User restored successfully');
         }

        //if($user->)
       // dd($user);


    }

     //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user handover page view
    //==========================================================


    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user data function
    //==========================================================

     public function userData(Request $request)
    {
        $user_id = $request->user_id;
        //dd($user_id);
        $user=User::where('_id',$user_id)->first();
        return response($user);

    }

      //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user data  import view page
    //==========================================================

     public function userImport(Request $request)
    {

         $permission = \App\RolePermission::where('role',Auth::user()->role)->first();
        $sub_permission= ($permission->sub_permissions)? json_decode($permission->sub_permissions,true) :  null;

        $count = 0;
         if( !empty($permission) )
        {

            foreach(@$permission->permission as $permissions){
                if(@$permissions == "user-management"){
                    $count ++;
                   return view('user.import');
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
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user data  import function
    //==========================================================

     public function userImportStore(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

       // dd($request->file);
        try{
            Excel::import(new ImportUser, $request->file);
            return redirect()->back()
                        ->with('success','Users Added successfully');
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::alert($e->failures());
        }

    }

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user update key  function
    //==========================================================

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user change password view page
    //==========================================================
    public function userChangePassword(Request $request,$id)
    {
        $user = $id;
         return view('user.change_password',compact('user'));
    }

    //==========================================================
    // Filename: UserController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use :  user change password update function
    //==========================================================

    public function updatePassword(Request $request)
    {


      /*   # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::where('_id',auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);*/
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = User::where('_id',$request->user_id)->first();


        #Match The Old Password
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::where('_id',$user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }




















}
