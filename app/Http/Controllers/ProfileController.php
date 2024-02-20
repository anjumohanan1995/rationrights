<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\MbaApplication;
use App\Role;
use App\PreviousUser;
use App\HandoverUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;


class ProfileController extends Controller
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
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user prifile view page
    //==========================================================

     public function index()
    {
        // $data = Auth::user()
        // ->join('mba_applications', 'users.student_id', '=', 'mba_applications._id')
        // ->select('users.*', 'mba_applications.*')
        // ->first();
    //     $data = Auth::user()
    // ->join('mba_applications', 'users._id', '=', 'mba_applications.student_id')
    // ->select('users.*', 'mba_applications.*')
    // ->first();
    $data = User::with('mbaApplication')->find(Auth::id());

        // dd($data);

        $role =Role::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('user.profile',compact('data','role'));
    }



    //==========================================================
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user delete function
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
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user edit view page
    //==========================================================

       public function edit( $id)
    {
        $data=User::find($id);
        $role =Role::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('user.edit',compact('data','role'));
    }

    //==========================================================
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user update function
    //==========================================================

     public function update(Request $request)
    {
        //dd("jj");
         request()->validate([
            'name' => 'required',
              'email' => 'required'

        ]);

         if($request->file('image')!='')
        {
        $image = $request->file('image');

        $input['image'] = uniqid().'.'.$image->extension();

        $destinationPath = public_path('/admin/uploads/images');
        $image->move($destinationPath, $input['image']);
    }
    else{
        $input['image']=$request->imgs;
    }




        $user=User::find(Auth::user()->id);
            $user->name=$request->name;
            $user->lname=$request->lname;
            $user->address=$request->address;
            $user->city=$request->city;
            $user->district=$request->district;
            $user->pin_code=$request->pin_code;
            $user->phone_no=$request->phone_no;
            $user->mobile=$request->mobile;
            $user->location=$request->location;

             $user->image=$input['image'];


            $user->email=$request->email;
            $user->save();

        //$book->update($request->all());

       return redirect()->back()
                       ->with('success','User updated successfully');
       //  return response()->json([
                        //'success' => 'User updated successfully.'
                  //  ]);
    }
    //==========================================================
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user handover view page
    //==========================================================


     public function handover()
    {
        $data=Auth::user();
        $role =Role::orderBy('id','desc')->where('deleted_at',null)->get();
        return view('user.de-register',compact('data','role'));
    }


    //==========================================================
    // Filename: ProfileController.php
    // Created: Kawika
    // Change history:
    // 11.05.2023 / Sreeja / Anju
    // Use : user handover update function page
    //==========================================================


     public function handoverUpdate(Request $request)
    {

        request()->validate([
              'name'   => 'required',
              'email'  => 'required',
              'pen_no' => 'required',

        ]);
         $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
            return redirect()->back()

                    ->with('danger','Invalid Credentials!');

        }
        if(Auth::user()->email != $request->email ){
            return redirect()->back()

                    ->with('danger','Email must be same!');
        }

       /* if(Auth::user()->password != Hash::make($request->password) ){
            return redirect()->back()

                    ->with('danger','Password be same!');
        }*/

        if($request->file('image')!='')
        {
        $image = $request->file('image');

        $name = uniqid().'.'.$image->extension();

        $destinationPath = public_path('/admin/uploads/images');
        $image->move($destinationPath, $name);
        }
        else{
            $name = '';
        }
        if(!empty($request->camera_id)){
            $camera_id = $request->camera_id;
            $camera =implode(',', $camera_id);
        }else{
            $camera ='';
        }

            $authData =  User::find(Auth::user()->id);
    //dd($authData->from_date);
            $previous =  PreviousUser::create([
                'name' => @$authData->name,
                'lname' => @$authData->lname,
                'pen_no' => @$authData->pen_no,
                'gender' => @$authData->gender,
                'dob' => @$authData->dob,
                'rank' => @$authData->rank,
                'camera_id' => @$authData->camera_id,

                'email' => @$authData->email,
                'password' => $authData->password,
                'address' => @$authData->address,
                'city' => @$authData->city,
                'phone_no' => @$authData->phone_no,
                'mobile' => @$authData->mobile,
                'location' => @$authData->location,
                'district' => @$authData->district,
                'pin_code' => @$authData->pin_code,
                'emp_id' => @$authData->emp_id,
                'image' => @$authData->image,
                'role' => @$authData->role,
                'user_id' =>Auth::user()->id,
                'from_date'=>@$authData->from_date,
                'hand_over_date'=>date("Y-m-d"),



            ]);

            $handover =  HandoverUser::create([

                'user_from' => @Auth::user()->id,
                'user_to' =>  @Auth::user()->id,
                'date' => date("Y-m-d"),
                'time' => date("h:i:s"),


            ]);

            $userUpdate=User::findOrFail(Auth::user()->id);

                $data = $request->all();
                $data['handover']  =1;
                $data['password'] =  Hash::make('kpsc@123');
                $data['from_date'] =date("Y-m-d");
                $userUpdate->update($data);







       /*$user =  User::create([
            'name' => @$request->name? $request->name:'',
            'lname' => @$request->lname?$request->lname:'',
            'pen_no' => @$request->pen_no?$request->pen_no:'',
            'gender' => @$request->gender?$request->gender:'',
            'dob' => @$request->dob?$request->dob:'',
            'rank' => @$request->rank?$request->rank:'',
             'camera_id' => @$request->camera_id?$camera:'',

            'email' => @$request->email?$request->email:'',
            'password' => Hash::make($request->password),
            'address' => @$request->address?$request->address:'',
            'city' => @$request->city?$request->city:'',
            'phone_no' => @$request->phone_no?$request->phone_no:'',
            'mobile' => @$request->mobile?$request->mobile:'',
            'location' => @$request->location?$request->location:'',
            'district' => @$request->district?$request->district:'',
            'pin_code' => @$request->pin_code?$request->pin_code:'',
            'emp_id' => @$request->emp_id?$request->emp_id:'',
            'image' => @$name,
            'role' => @$request->role?$request->role:''

        ]);
*/


       //$data= User::find(Auth::user()->id)->delete();








        //$book->update($request->all());

       return redirect()->back()
                       ->with('success','User handover successfully');
       //  return response()->json([
                        //'success' => 'User updated successfully.'
                  //  ]);
    }






    public function editPassword(){

        return view('admin.edit-password');
    }
    public function editPasswordPost(Request $request){


        request()->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'conf_password' => 'required|same:new_password',
        ]);

        $enteredPassword = $request->current_password;
        $user = User::where('_id', Auth::user()->id)->where('deleted_at', null)->first();


        if ($user && Hash::check($enteredPassword, $user->password)) {
            // Password is correct
            if($request->new_password === $request->conf_password){

                $user->password = hash::make($request->new_password);
                $user->save();

            }
            return redirect('login')->with('succes','Password successfully changed!');

        } else {
            // Password is incorrect

            return redirect()->back()->with('error','Incorrect current password!');
        }


    }






}
