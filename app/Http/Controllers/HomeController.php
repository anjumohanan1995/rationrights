<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\Role;
use App\RolePermission;
use App\Visitor;


use Date;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use Auth;

use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
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
   /* public function index_old()
    {
         return view('admin.dashboard');
    }*/

    public function index()
    {


        // $role =Auth::user()->role;

        // if($role == 'Admin')
        // {

        //     return view('admin.dashboard');
        // }
        // if($role == 'Student')
        // {

        //     $data=User::with('MbaApplication')->where('_id',Auth::user()->id)->first();
        //    // $datas=MbaApplication::where('_id',Auth::user()->student_id)->first();
        //     $interview=GdInterview::where('application_id',Auth::user()->student_id)->first();
        //     $upload = Receipt::where('application_id',$data->MbaApplication->id)->first();
        //     return view('student.dashboard',compact('data','interview','upload'));
        // }
        // if($role == 'Staff'){

        //     $d1 =date("Y-m-d");
        //     $startDate = Carbon::createFromFormat('Y-m-d',  $d1)->startOfDay();

        //     $endDate = Carbon::createFromFormat('Y-m-d', $d1)->endOfDay();

        //     $userListAllCount1  =  User::where('deleted_at',null)->get();
        //     $data['userListAllCount']  =  count($userListAllCount1);

        //     $userListTodayCount1      = User::whereBetween('created_at',[$startDate, $endDate])->get();
        //     $data['userListTodayCount']  =  count($userListTodayCount1);

        //     $totalVisitorsCount1  = Visitor::where('deleted_at',null)->get();
        //     $data['totalVisitorsCount']  =  count($totalVisitorsCount1);

        //     $todayVisitorsCount1  = Visitor::where('deleted_at',null)->where('date',$d1)->get();
        //     $data['todayVisitorsCount']  =  count($todayVisitorsCount1);


        //     $applicationListAllCount1  =  MbaApplication::where('deleted_at',null)->get();
        //     $data['applicationListAllCount']  =  count($applicationListAllCount1);


        //     $applicationListTodayCount1      = MbaApplication::whereBetween('created_at',[$startDate, $endDate])->get();
        //     $data['applicationListTodayCount']  =  count($applicationListTodayCount1);


        //     $applicationListTodayGdCount     = GdInterview::where('gd_date',$d1)->get();
        //     $data['applicationListTodayGdCount']  =  count($applicationListTodayGdCount);
        //     $applicationListTodayInterviewCount     = GdInterview::where('gd_date',$d1)->get();
        //     $data['applicationListTodayInterviewCount']  =  count($applicationListTodayGdCount);
        //     $gd = GdInterview::pluck('application_id')->all();

        //      $GdPending = MbaApplication::where('status',1)->whereNotIn('_id',$gd)->pluck('_id')->all();
        //          $data['GdPending']  =  count($GdPending);
        //  $in=  MbaApplication::where('status',1)->pluck('_id')->all();
        //  $interviewPending=GdInterview::where('gd_date','!=',null)->whereNotIn('_id',$in)->where('interview_date',null)->pluck('application_id')->all();

        //  $data['interviewPending']  =  count($interviewPending);
        //  $interviewCompleted=GdInterview::where('interview_date','!=',null)->whereNotIn('_id',$in)->where('interview_score','!=',null)->pluck('application_id')->all();

        //  $data['interviewCompleted']  =  count($interviewCompleted);
        //  $gdCompleted=GdInterview::where('gd_date','!=',null)->whereNotIn('_id',$in)->where('gd_score','!=',null)->pluck('application_id')->all();

        //  $data['gdCompleted']  =  count($gdCompleted);


        //    // dd($data);
        //     return view('staff.dashboard',compact('data'));
        return view('admin.dashboard');




    }

     public function changeStatus(Request $request){
        $request =$request->all();
        //dd($request);
        $status="aone";
        if($request['status']){
            $status=$request['status'];
        }
       // App::setLocale($status);
        //Session::put('status', $status);
        session()->put('style_status', $status);
        //dd($request['status']);
        return redirect()->back();
    }


    public function profileMange(){
        // dd('hl');

        return view('student.profile');
    }


    public function landGovernance(){
        return view('home.land-governance');
    }
    public function disasterManagement(){
        return view('home.disaster-management');
    }
    public function waterRivermangement(){
        return view('home.water-management');
    }








}
