<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

use App\ApplicationDate;
use App\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Redirect;
use Excel;
use App\Imports\ImportUser;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Auth;




class StaffController extends Controller
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


    
    
    public function setDate(Request $request)
    {
        $staff_id =Auth::user()->id;
        //dd($staff_id);
        $data = ApplicationDate::where('staff_id',$staff_id)->first();
       // dd($data );
         return view('staff.setdate',compact('data'));
    }

    public function setDateStore(Request $request)
    {

        $data = ApplicationDate::where('staff_id',$request->staff_id)->first();
        if($data != ''){
            ApplicationDate::where('staff_id',$request->staff_id)->update(['start_date'=>$request->start_date,'end_date'=>$request->end_date]);
        }else{

            ApplicationDate::create([
            'staff_id' => @$request->staff_id? $request->staff_id:'',
            'start_date' => @$request->start_date?$request->start_date:'',
            'end_date' =>@$request->end_date?$request->end_date:'',
           
            ]);

        

        }
         return redirect()->back()

                    ->with('success','Data Updated successfully.');
    }

    


    


}
