<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotlist;
use App\HotRecord;
use Carbon\Carbon;
use App\Location;
use App\Records;
use App\HotlistCount;
use App\Notification;
use App\ImageDownload;
use Carbon\CarbonPeriod;
use Excel;
use App\Imports\ImportHotlist;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Redirect;
 
class HotlistController extends Controller
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
    public function index()
    {
        $permission = \App\RolePermission::where('role',Auth::user()->role)->first();
        $sub_permission= ($permission->sub_permissions)? json_decode($permission->sub_permissions,true) :  null;

        $totalRecords = Hotlist::where('deleted_at',null)->get();
        foreach($totalRecords as $totalRecord){

                $currentDateTime = Carbon::now();
                $cDate =$currentDateTime->toDateString();
                $stDate = new Carbon($totalRecord->created_at);
                if($totalRecord->expire != ''){
                    $newDate = $stDate->addDays($totalRecord->expire);
                    $newDate1 =$newDate->toDateString();

                    if($newDate1 == $cDate){
                            $data= Hotlist::find($totalRecord->id)->delete();

                    }
                }




        }



        return view('hotlist.index',compact('permission','sub_permission'));
    }
      public function csvgeneration($id)
    {
     //dd("ll");

            $d1 = $request->date;
            $table ="records_".$d1;

            $headers = array(
                'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename=abc.csv',
                'Expires' => '0',
                'Pragma' => 'public',
            );

            $filename = "records_".$d1.".csv";
           // $path ='records/';
            $handle = fopen($filename, 'w');
            fputcsv($handle, [
                "Register Number",
                "Date",
                "Time",
                "Location",
                "Vehicle Direction",
                "Make",
                "Colour",
                "Photo",
                "Violation",
                "City",
                "Lane Name",
                "Camera ID",

            ]);

          //  $items = Records::whereBetween('created_at',[$startDate, $endDate])->limit(1000);
            //$items = Records::query();
           $items = DB::table($table)->where('deleted_at',null)->orderBy('time','asc');

            $items->chunk(1000, function ($data) use ($handle) {
                foreach ($data as $row) {
                    // Add a new row with data
                    fputcsv($handle, [
                        $row['regi_no'],
                        $row['date'],
                        $row['time'],
                        $row['location'],
                        $row['vehicle_dir'],
                        $row['make'],
                        $row['colour'],
                        $row['photo'],
                        $row['violation'],
                        $row['city'],
                        $row['lane_name'],
                        $row['camera_id'],

                    ]);
                }
            });
            fclose($handle);
            return response()->download($filename,$filename, $headers);

           // $datas = Records::whereBetween('created_at',[$startDate, $endDate])->delete();
            return redirect()->back()->with('success','CSV File created successfully');

        //dd($id);
    }

    public function create()
    {
        return view('hotlist.create');
    }

      public function store(Request $request)
    {


         $validate = Validator::make($request->all(),
            [
            /* 'lp_number' => 'required|unique:hotlists',*/
            'lp_number' => 'required|min:1|unique:hotlists,lp_number,NULL,id,deleted_at,NULL|max:12'



        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }

        $data = $request->all();
        //$data['added_by'] = Auth::user()->id;

        Hotlist::create($data);



        $date = date("Y-m-d");
        $data = HotlistCount::where('date',$date)->first();
        if(!empty($data))
        {
            $count = $data->count;
            $newCount = $count+1;
            HotlistCount::where('date',$date)->update(['count'=>$newCount]);

        }else{
            HotlistCount::create([ 'date'=>$date, 'count'=>1 ]);

        }



         return redirect()->route('register-hotlist.index')

                    ->with('success','Hotlist Added successfully.');

       // eturn redirect()->back()->with('error', 'Cannot delete the user. The user may be a super or root user.');
         /* return response()->json([
                        'success' => 'Hotlist created successfully.'
                    ]);*/

    }



       // Fetch records
    public function getHotlist(Request $request){
            $lp_number = $request->lp_number;
            $model  =  $request->model;
            $colour =  $request->colour;

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

                $totalRecord = Hotlist::where('deleted_at','!=',null);

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Hotlist::where('deleted_at','!=',null);



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Hotlist::where('deleted_at','!=',null)->orderBy($columnName,$columnSortOrder);

                $records = $items->skip($start)->take($rowperpage)->get();
            }else{

                // Total records
                $totalRecord = Hotlist::where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');
                if($lp_number != ""){
                    $totalRecord->where('lp_number','like',"%".$lp_number."%");
                }
                if($model != "Select"){
                    $totalRecord->where('model',$model);
                }
                if($colour != "Select" ){
                    //echo "khk";exit;
                    $totalRecord->where('colour', $colour);
                }


                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = Hotlist::where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');

                if($lp_number != ""){
                    $totalRecordswithFilte->where('lp_number','like',"%".$lp_number."%");
                }
                if($model != "Select"){
                    $totalRecordswithFilte->where('model',$model);
                }
                if($colour != "Select" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->where('colour', $colour);
                }



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = Hotlist::with('UserDelete')->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC')->orderBy($columnName,$columnSortOrder);
                if($lp_number != ""){
                    $items->where('lp_number','like',"%".$lp_number."%");
                }
                if($model != "Select"){
                    $items->where('model',$model);
                }
                if($colour != "Select" ){
                    //echo "khk";exit;
                    $items->where('colour', $colour);
                }

                $records = $items->skip($start)->take($rowperpage)->get();
            }

 

            $data_arr = array();
            $i =1;
            foreach($records as $record){

                $id = $record->id;
                $lp_number = $record->lp_number;
                 $category = $record->category;
                $make =  $record->make;
                 $model =  $record->model;
                 $colour =  $record->colour;
                 $description =  $record->description;
                $date =  $record->date;
                $time =  $record->time;
                $deleted_date =  @$record->deleted_date;
                $deleted_time =  @$record->deleted_time;
                $deleted_by =  @$record->UserDelete->name;
                  if($record->deleted_at != null){
                  $edit = '<div class="settings-main-icon">Deleted By :'.$deleted_by.',Date : '.$deleted_date.' and Time : '.$deleted_time.'</div>';
                  //  $edit = '';
                  }else{
                    $edit = '<div class="settings-main-icon"><a  href="' . url('register-hotlist/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
                  }



               
               $data_arr[] = array(
                   "id" => $id,
                   "slno" =>$i,

                   "lp_number" => $lp_number,
                   "category" => $category,
                  "make" => $make,
                   "model" => $model,

                    "date" => $date,
                    "time" => $time,

                   "colour" => $colour,
                    "description" => $description,
                   "edit" => $edit

               );
               $i++;
            }

            $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );

            return response()->json($response);
    }







    public function getHotlistTracker_bkp(Request $request){
            $lp_number = $request->lp_number;
               if($request->from_date !=''){

                $from_date  = date("M d,Y",strtotime($request->from_date));
                $stDate = new Carbon($from_date);
            }
            if($request->to_date !=''){
                $to_date  =   date("Y-m-d",strtotime($request->to_date));
                $edDate = new Carbon($to_date);
            }

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

            $hotlist= Hotlist::where('lp_number',$lp_number)->latest()->first();
            
              




            if($lp_number != "" || $request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != ""){



                // Total records
                $date =date("Y-m-d");
                $table = 'records_'.$date;

               // $data= DB::table($table)->


                $totalRecord =  DB::table($table);
                if($lp_number != ""){
                    $totalRecord->where('regi_no',$lp_number);
                }
                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
                }*/

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte =  DB::table($table);

                if($lp_number != ""){
                    $totalRecordswithFilte->where('regi_no',$lp_number);
                }
                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
                }*/
                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items =  DB::table($table)->orderBy($columnName,$columnSortOrder);
                if($lp_number != ""){
                    $items->where('regi_no','like',"%".$lp_number."%");
                }
                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    $items->whereBetween('created_at', [$stDate, $edDate]);
                }*/

                $records = $items->skip($start)->take($rowperpage)->get();


                $data_arr = array();

                    foreach($records as $record){
                        $id = (string)$record['_id'];
                        $lp_number = $record['regi_no'];
                        $make =  $record['make'];
                        $colour = $record['colour'];
                        $date =  $record['date'];
                        $time =  $record['time'];
                        $location =  $record['location'];
                        $district =  $record['city'];
                        $data_arr[] = array(
                            "id" => $id,
                            "lp_number" => $lp_number,
                            "make" => $make,
                            "date" => $date,
                            "location" => $location,
                            "time" => $time,
                            "colour" => $colour,
                            "district" => $district,
                            "edit" => '<div class="settings-main-icon"><a  href="' . url('register-hotlist/'.$id.'/edit') . '"><i class="fe fe-edit-2 bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="si si-trash bg-danger "></i></a></div>'

                       );
                    }

                    $response = array(
                       "draw" => intval($draw),
                       "iTotalRecords" => $totalRecords,
                       "iTotalDisplayRecords" => $totalRecordswithFilter,
                       "aaData" => $data_arr
                    );

                    return response()->json($response);



            }else{
                $records =array();
                 $data_arr[] = array(
                   "id" => '',
                   "lp_number" => '',
                   "category" => '',
                  "make" => '',
                   "model" => '',
                     "date" => '',
                    "time" => '',
                    "location" => '',
                    "district" => '',
                   "colour" => '',
                    "description" => ''


               );
                 $draw =0;
                 $totalRecords =0;
                 $totalRecordswithFilter  =0;
                $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );

            return response()->json($response);
            }





    }
     public function getHotlistTracker(Request $request){
            $lp_number = $request->lp_number;
            if($request->from_date !=''){

                $from_date  = date("Y-m-d",strtotime($request->from_date));
                $stDate = new Carbon($from_date);
            }
            if($request->to_date !=''){
                $to_date  =   date("Y-m-d",strtotime($request->to_date));
                $edDate = new Carbon($to_date);
            }

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

            $hotlist= Hotlist::where('lp_number',$lp_number)->latest()->first();
            
              




            if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != ""){




                // Total records
                $date =date("Y-m-d");
                $table = 'hotrecords';

               // $data= DB::table($table)->


                $totalRecord =  HotRecord::orderBy('date','desc')->orderBy('time','desc');
                if($lp_number != ""){
                    $totalRecord->where('regi_no','like',"%".$lp_number."%");
                }
                if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    $totalRecord->whereDate('date', '>=', $stDate)->whereDate('date', '<=', $edDate);
                }

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte =  HotRecord::orderBy('date','desc')->orderBy('time','desc');

                if($lp_number != ""){
                    $totalRecordswithFilte->where('regi_no','like',"%".$lp_number."%");
                }
                if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->whereDate('date', '>=', $stDate)->whereDate('date', '<=', $edDate);
                }
                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = HotRecord::orderBy('date','desc')->orderBy('time','desc')->orderBy($columnName,$columnSortOrder);
                if($lp_number != ""){
                    $items->where('regi_no','like',"%".$lp_number."%");
                }
                if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){
                    //echo "khk";exit;
                    //$items->whereDate('date', [$stDate, $edDate]);
                      $items->whereDate('date', '>=', $stDate)->whereDate('date', '<=', $edDate);
                }
               // $records = $items->get();
                //return  $records;

                $records = $items->skip($start)->take($rowperpage)->get();


                $data_arr = array();

                    foreach($records as $record){
                        $id = (string)$record['_id'];
                        $lp_number = $record['regi_no'];
                        $make =  $record['make'];
                        $colour = $record['colour'];
                        $date =  $record['date'];
                        $time =  $record['time'];
                        $location =  $record['location'];
                        $district =  $record['city'];
                        $data_arr[] = array(
                            "id" => $id,
                            "lp_number" => $lp_number,
                            "make" => $make,
                            "date" => $date,
                            "location" => $location,
                            "time" => $time,
                            "colour" => $colour,
                            "district" => $district,
                            "edit" => '<div class="settings-main-icon"><a  href="' . url('register-hotlist/'.$id.'/edit') . '"><i class="fe fe-edit-2 bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="si si-trash bg-danger "></i></a></div>'

                       );
                    }

                    $response = array(
                       "draw" => intval($draw),
                       "iTotalRecords" => $totalRecords,
                       "iTotalDisplayRecords" => $totalRecordswithFilter,
                       "aaData" => $data_arr
                    );

                    return response()->json($response);



            }else{
                $records =array();
                 $data_arr[] = array(
                   "id" => '',
                   "lp_number" => '',
                   "category" => '',
                  "make" => '',
                   "model" => '',
                     "date" => '',
                    "time" => '',
                    "location" => '',
                    "district" => '',
                   "colour" => '',
                    "description" => ''


               );
                 $draw =0;
                 $totalRecords =0;
                 $totalRecordswithFilter  =0;
                $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );

            return response()->json($response);
            }





    }





    public function getnumberTrackerNew(Request $request){
            $data_arr = array();
            $date_array =array();
            $regi_no = $request->regi_no;
            $make  =  $request->make;
            $colour =  $request->colour;
            $location =  $request->location;
            $district =  $request->district;

            $location = $request->location;
            $camera = $request->camera;

            if($request->from_date !=''){

                $from_date  = date("Y-m-d",strtotime($request->from_date));
                $stDate = new Carbon($from_date);
            }
            if($request->to_date !=''){
                $to_date  =   date("Y-m-d",strtotime($request->to_date));
                $edDate = new Carbon($to_date);
            }

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




            if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){

                    $period = CarbonPeriod::create($from_date, $to_date);

                    // Iterate over the period
                    foreach ($period as $date) {
                        $date_array[] = $date->format('Y-m-d');
                    }
            }



        if (!empty($date_array))
        {
            //return "if";

            $totalRecords=$totalRecordswithFilter=0;

            foreach ($date_array as $lkey => $lvalue) {


                //================================================================

                $table = 'records_'.$lvalue;
                $totalRecord = DB::table($table)->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC')->where('date',$lvalue);
                if($regi_no != ""){
                    $totalRecord->where('regi_no','like',"%".$regi_no."%");
                }

               /* if($make != ""){
                    $totalRecord->where('make','like',"%".$make."%");
                }

                if($colour != ""){
                    $totalRecord->where('colour','like',"%".$colour."%");
                }

                if($location != ""){
                    $totalRecord->where('location','like',"%".$location."%");
                }

                if($camera != ""){
                    $totalRecord->where('camera_id','like',"%".$camera."%");
                }

                if($district != "District"){
                    $totalRecord->where('city','like',"%".$district."%");
                }*/

                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){



                    $totalRecord->whereDate('date', '>=', $stDate);
                    $totalRecord->whereDate('date', '<=', $edDate);
                }
                */
                $totalRecords = intval($totalRecords)+intval($totalRecord->select('count(*) as allcount')->count());


                $totalRecordswithFilte = DB::table($table)->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');

                if($regi_no != ""){
                    $totalRecordswithFilte->where('regi_no','like',"%".$regi_no."%");
                }

                /*if($make != ""){
                    $totalRecordswithFilte->where('make','like',"%".$make."%");
                }

                if($colour != ""){
                    $totalRecordswithFilte->where('colour','like',"%".$colour."%");
                }

                if($location != ""){
                    $totalRecordswithFilte->where('location','like',"%".$location."%");
                }

                if($camera != ""){
                    $totalRecordswithFilte->where('camera_id','like',"%".$camera."%");
                }

                if($district != "District"){
                    $totalRecordswithFilte->where('city','like',"%".$district."%");
                }*/

                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" )
                {
                    $totalRecordswithFilte->whereDate('date', '>=', $stDate);
                    $totalRecordswithFilte->whereDate('date', '<=', $edDate);
                }*/


                $totalRecordswithFilter = intval($totalRecordswithFilter) + intval($totalRecordswithFilte->select('count(*) as allcount')->count());

                $items =DB::table($table)->where('deleted_at',null)->orderBy($columnName,$columnSortOrder)->orderBy('date','DESC')->orderBy('time','DESC');

                if($regi_no != "")
                {
                    $items->where('regi_no','like',"%".$regi_no."%");
                }

               /* if($make != "")
                {
                    $items->where('make','like',"%".$make."%");
                }

                 if($colour != ""){
                    $items->where('colour','like',"%".$colour."%");
                }
                  if($location != ""){
                    $items->where('location','like',"%".$location."%");
                }
                if($camera != ""){
                    $items->where('camera_id','like',"%".$camera."%");
                }
                if($district != "District"){
                    $items->where('city','like',"%".$district."%");
                }
                */
               /* if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){

                    $items->whereDate('date', '>=', $stDate);
                    $items->whereDate('date', '<=', $edDate);
                }*/

                $records = $items->skip($start) ->options(['allowDiskUse' => true])->take($rowperpage)->get();


                foreach($records as $record){


                    $id = (string)$record['_id'];
                    $regi_no = $record['regi_no'];
                    $date = $record['date'];
                    $location =  $record['location'];
                    $make =  $record['make'];
                    $colour =  $record['colour'];
                    $time =  $record['time'];
                    $lane_name =  $record['lane_name'];
                    $vio =  $record['violation'];
                    $photo =  $record['photo'];
                    $camera_id =  $record['camera_id'];
                    $city =  $record['city'];

                    if($vio == 'helmet_violation'){
                        $violation ='<img src="' . url('img/helmet.png').  '">';
                    }elseif($vio == 'speed_violation'){
                        $violation ='<img src="' . url('img/speed.png').  '">';
                    }else{
                        $violation ='';
                    }

                    $data_arr[] = array(
                        "id" => $id,
                        "regi_no" => $regi_no,
                        "date" => $date,
                        "time" => $time,
                        "lane_name" => $lane_name,
                        "location" => $location,
                        "make" => $make,
                        "colour" => $colour,
                        "city" => $city,
                        'camera_id'=> $camera_id,
                        "violation" => $violation,
                        "photo" => '<img src="' . $photo . '">',
                         "more" => '<div class="settings-main-icon"><a  href="' . url('search-management-show/'.$regi_no."/".$lvalue."/".$camera_id). '"><i class="fa fa-eye bg-info me-1"></a></div>',
                        "add" => '<div class="settings-main-icon"><a class="challan" data-id="'.$id.'" data-name="'.$regi_no.'"><i class="fa fa-plus bg-info "></i></a></div>'

                   );
                }



            }


            $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );
            //================================================================


        }else{
            //return "else";

                $date =date("Y-m-d");
                $table = 'records_'.$date;
                $totalRecord = DB::table($table)->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');
                if($regi_no != ""){
                    $totalRecord->where('regi_no','like',"%".$regi_no."%");
                }

              /*  if($make != ""){
                    $totalRecord->where('make','like',"%".$make."%");
                }

                if($colour != ""){
                    $totalRecord->where('colour','like',"%".$colour."%");
                }

                if($location != ""){
                    $totalRecord->where('location','like',"%".$location."%");
                }

                if($camera != ""){
                    $totalRecord->where('camera_id','like',"%".$camera."%");
                }

                if($district != "District"){
                    $totalRecord->where('city','like',"%".$district."%");
                }*/

               /* if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){

                    $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
                }*/

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();

                $totalRecordswithFilte = DB::table($table)->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');

                if($regi_no != ""){
                    $totalRecordswithFilte->where('regi_no','like',"%".$regi_no."%");
                }

             /*   if($make != ""){
                    $totalRecordswithFilte->where('make','like',"%".$make."%");
                }

                if($colour != ""){
                    $totalRecordswithFilte->where('colour','like',"%".$colour."%");
                }

                if($location != ""){
                    $totalRecordswithFilte->where('location','like',"%".$location."%");
                }

                if($camera != ""){
                    $totalRecordswithFilte->where('camera_id','like',"%".$camera."%");
                }

                if($district != "District"){
                    $totalRecordswithFilte->where('city','like',"%".$district."%");
                }*/

               /* if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" )
                {
                    $totalRecordswithFilte->whereDate('date', '>=', $stDate);
                    $totalRecordswithFilte->whereDate('date', '<=', $edDate);
                }*/

                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                $items =DB::table($table)->where('deleted_at',null)->orderBy($columnName,$columnSortOrder)->orderBy('date','DESC')->orderBy('time','DESC');

                if($regi_no != "")
                {
                    $items->where('regi_no','like',"%".$regi_no."%");
                }

                /*if($make != "")
                {
                    $items->where('make','like',"%".$make."%");
                }

                 if($colour != ""){
                    $items->where('colour','like',"%".$colour."%");
                }
                  if($location != ""){
                    $items->where('location','like',"%".$location."%");
                }
                if($camera != ""){
                    $items->where('camera_id','like',"%".$camera."%");
                }
                if($district != "District"){
                    $items->where('city','like',"%".$district."%");
                }*/

                /*if($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "" ){

                    $items->whereDate('date', '>=', $stDate);
                    $items->whereDate('date', '<=', $edDate);
                }*/

                $records = $items->skip($start)->take($rowperpage)->get();
                //return $records;



            foreach($records as $record){


                $id = (string)$record['_id'];
                $regi_no = $record['regi_no'];
                $date = $record['date'];
                $location =  $record['location'];
                $make =  $record['make'];
                $colour =  $record['colour'];
                $time =  $record['time'];
                $lane_name =  $record['lane_name'];
                $vio =  $record['violation'];
                $photo =  $record['photo'];
                $camera_id =  $record['camera_id'];
                $city =  $record['city'];

                if($vio == 'helmet_violation'){
                    $violation ='<img src="' . url('img/helmet.png').  '">';
                }elseif($vio == 'speed_violation'){
                    $violation ='<img src="' . url('img/speed.png').  '">';
                }else{
                    $violation ='';
                }

                $data_arr[] = array(
                    "id" => $id,
                    "regi_no" => $regi_no,
                    "date" => $date,
                    "time" => $time,
                    "lane_name" => $lane_name,
                    "location" => $location,
                    "make" => $make,
                    "colour" => $colour,
                    "city" => $city,
                    'camera_id'=> $camera_id,
                    "violation" => $violation,
                    "photo" => '<img src="' . $photo . '">',
                     "more" => '<div class="settings-main-icon"><a  href="' . url('search-management-show/'.$regi_no."/".$date."/".$camera_id). '"><i class="fa fa-eye bg-info me-1"></a></div>',
                    "add" => '<div class="settings-main-icon"><a class="challan" data-id="'.$id.'" data-name="'.$regi_no.'"><i class="fa fa-plus bg-info "></i></a></div>'

               );
            }

            $response = array(
               "draw" => intval($draw),
               "iTotalRecords" => $totalRecords,
               "iTotalDisplayRecords" => $totalRecordswithFilter,
               "aaData" => $data_arr
            );

        }
        return response()->json($response);
    }

    public function edit( $id)
    {
        $data=Hotlist::find($id);
        return view('hotlist.edit',compact('data'));
    }

     public function update(Request $request, $id)
    {

         request()->validate([
          'lp_number' => 'required',
        ]);


        $book=Hotlist::findOrFail($id);

        $book->update($request->all());

        return redirect()->route('register-hotlist.index')

                    ->with('success','Hotlist updated successfully.'); 


         /*return response()->json([
                        'success' => 'Hotlist updated successfully.'
                    ]);*/
    }

     public function destroy($id)
    {

        //$data= Hotlist::find($id)->delete();
        $date = date("Y-m-d");
        $time = date("h:i:s");
        $update =Hotlist::where('_id',$id)->update(['deleted_by'=>Auth::user()->id,'deleted_date'=>$date,'deleted_time'=>$time]);


        $data= Hotlist::find($id)->delete();

        return response()->json([
                        'success' => 'Hotlist Deleted successfully.'
                    ]);

        //return redirect()->route('patients.index')
                        //->with('success','Patient deleted successfully');
    }

     public function expireHotlist(Request $request)
    {
        $totalRecords = Hotlist::where('deleted_at',null)->get();
        foreach($totalRecords as $totalRecord){

                $currentDateTime = Carbon::now();
                $cDate =$currentDateTime->toDateString();
                $stDate = new Carbon($totalRecord->created_at);
                if($totalRecord->expire != ''){
                    $newDate = $stDate->addDays($totalRecord->expire);
                    $newDate1 =$newDate->toDateString();

                    if($newDate1 == $cDate){
                            $data= Hotlist::find($totalRecord->id)->delete();

                    }
                }



           // dd($totalRecord->created_at);

        }

      //  dd($totalRecord);
    }












    public function hotlistRecord()
    {

        return view('hotlist.record'); 
    }

    public function hotlistTracker()
    {
        $locations = Location::where('deleted_at',null)->get();
        return view('hotlist.tracker',compact('locations'));
    }




       // Fetch records
    public function getRecords(Request $request){
            $lp_number = $request->lp_number;
            $model  =  $request->model;
            $colour =  $request->colour;
           // dd($model ."and   colour".$colour);

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

                $totalRecord = HotRecord::where('deleted_at','!=',null);

                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = HotRecord::where('deleted_at','!=',null);



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = HotRecord::where('deleted_at','!=',null)->orderBy($columnName,$columnSortOrder);

                $records = $items->skip($start)->take($rowperpage)->get();
            }else{

                // Total records
                $totalRecord = HotRecord::where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');
                if($lp_number != ""){
                    $totalRecord->where('regi_no','like',"%".$lp_number."%");
                }
                if($model != ""){
                    $totalRecord->where('make',$model);
                }
                if($colour != "" ){
                    //echo "khk";exit;
                    $totalRecord->where('colour', $colour);
                }


                $totalRecords = $totalRecord->select('count(*) as allcount')->count();


                $totalRecordswithFilte = HotRecord::where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');

                if($lp_number != ""){
                    $totalRecordswithFilte->where('regi_no','like',"%".$lp_number."%");
                }
                if($model != ""){
                    $totalRecordswithFilte->where('make',$model);
                }
                if($colour != "" ){
                    //echo "khk";exit;
                    $totalRecordswithFilte->where('colour', $colour);
                }



                $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

                // Fetch records
                $items = HotRecord::where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC')->orderBy($columnName,$columnSortOrder);
                if($lp_number != ""){
                    $items->where('regi_no','like',"%".$lp_number."%");
                }
                if($model != ""){
                    $items->where('make',$model);
                }
                if($colour != "" ){
                    //echo "khk";exit;
                    $items->where('colour', $colour);
                }

                $records = $items->skip($start)->take($rowperpage)->get();
            }



            $data_arr = array();

            foreach($records as $record){
                $id = $record->id;
                $regi_no = $record->regi_no;
                $date = $record->date;
                $time = $record->time;
                $city =  $record->city;
                $camera_id =  $record->camera_id;
                  

                $location =  $record->location;
                 $make =  $record->make;
                 $colour =  $record->colour;

                  /*$table = 'records_'.$date;
                 $view =  DB::table($table)->where('regi_no',$regi_no)->where('date',$date)->where('time',$time)->first();*/

               $data_arr[] = array(
                   "id" => $id,
                   "regi_no" => $regi_no,
                   "date" => $date,
                  "location" => $location,
                   "date" => $date,
                   "time" => $time,
                   "city" => $city,
                   "camera_id" => $camera_id,
                   "make" => $make,

                   "colour" => $colour,

                   "edit" => '<div class="settings-main-icon"><a  href="' . url('register-hotlist/'.$id.'/edit') . '"><i class="fe fe-edit-2 bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="si si-trash bg-danger "></i></a></div>',

                    "more" => '<div class="settings-main-icon"><a  href="' . url('search-management-show/'.$regi_no."/".$date."/".$camera_id). '"><i class="fa fa-eye bg-info me-1"></a></div>',

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

    public function recordLocations($id,$id1,$id2){

        $regi_no = $id;



        $hotlist= Hotlist::where('lp_number',$regi_no)->latest()->first();
        if(!empty($hotlist)){
            //return "if";


            $date =date("Y-m-d");
            $table = 'hotrecords';
                    //$totalRecord = DB::table($table)
            $data = DB::table($table)->where('regi_no',$regi_no)->orderBy('date','DESC')->orderBy('time','DESC');
            if($id1!= "1970-01-01" && $id2 != "1970-01-01" && $id1 != "" && $id2 != "" ){
                    //echo "khk";exit;
                    $data->whereBetween('date', [$id1, $id2]);
                }



            $datas = $data->get();




            $locations = Location::where('deleted_at',null)->get();
            $test =[];
            $te   =[];
           // $tt =array();
            foreach($locations as $location){
                foreach($datas as  $data){
                    if($data['location'] == $location['location_name'] && $data['camera_id'] == $location['camera_id'] ){
                       // print_r( $location);
                        $test[] = $location;
                    }
                }


            }
           $te= array_reverse($test);


            return $te;
        }else{
            //return "else";
            $response ="not";
            return response()->json($response);
        }



    }

     public function numberTrackLocations($id,$id1,$id2){
        $regi_no = $id;

         if($id1 !=''){

                $from_date  = date("Y-m-d",strtotime($id1));
                $stDate = new Carbon($id1);
            }
            if($id2 !=''){
                $to_date  =   date("Y-m-d",strtotime($id2));
                $edDate = new Carbon($id2);
            }

        if($id1 != "1970-01-01" && $id2 != "1970-01-01" && $id1 != "" && $id2 != "" ){

            $period = CarbonPeriod::create($from_date, $to_date);

            // Iterate over the period
            foreach ($period as $date) {
                $date_array[] = $date->format('Y-m-d');
            }
        }
        if (!empty($date_array))
        {


            foreach ($date_array as $lkey => $lvalue) {


                //================================================================

                $table = 'records_'.$lvalue;

                $items =DB::table($table)->where('deleted_at',null)->orderBy('date','DESC')->orderBy('time','DESC');

                if($regi_no != "")
                {
                    $items->where('regi_no','like',"%".$regi_no."%");
                }

                $records = $items->get();

                foreach($records as $record){

                    $id = (string)$record['_id'];
                    $regi_no = $record['regi_no'];
                    $date = $record['date'];
                    $location =  $record['location'];
                    $make =  $record['make'];
                    $colour =  $record['colour'];
                    $time =  $record['time'];
                    $lane_name =  $record['lane_name'];
                    $vio =  $record['violation'];
                    $photo =  $record['photo'];
                    $camera_id =  $record['camera_id'];
                    $city =  $record['city'];

                    if($vio == 'helmet_violation'){
                        $violation ='<img src="' . url('img/helmet.png').  '">';
                    }elseif($vio == 'speed_violation'){
                        $violation ='<img src="' . url('img/speed.png').  '">';
                    }else{
                        $violation ='';
                    }
                    $data_arr[] = array(
                        "id" => $id,
                        "regi_no" => $regi_no,
                        "date" => $date,
                        "time" => $time,
                        "lane_name" => $lane_name,
                        "location" => $location,
                        "make" => $make,
                        "colour" => $colour,
                        "city" => $city,
                        'camera_id'=> $camera_id,
                        "violation" => $violation,
                        "photo" => '<img src="' . $photo . '">',
                         "more" => '<div class="settings-main-icon"><a  href="' . url('search-management-show/'.$regi_no."/".$lvalue."/".$camera_id). '"><i class="fa fa-eye bg-info me-1"></a></div>',
                        "add" => '<div class="settings-main-icon"><a class="challan" data-id="'.$id.'" data-name="'.$regi_no.'"><i class="fa fa-plus bg-info "></i></a></div>'

                   );
                }



            }
        }

       // dd($data_arr);





        /*$regi_no = $id;
        $date =date("Y-m-d");
                $table = 'records_'.$date;
                //$totalRecord = DB::table($table)
        $datas = DB::table($table)->where('regi_no',$regi_no)->orderBy('date','DESC')->orderBy('time','DESC')->get();*/




        $locations = Location::where('deleted_at',null)->get();
        $test =[];
       // $tt =array();
        foreach($locations as $location){
            foreach($data_arr as  $data){
                if($data['location'] == $location['location_name'] && $data['camera_id'] == $location['camera_id'] ){
                   // print_r( $location);
                    $test[] = $location;
                }
            }

        }

        return $test;



    }



    public function hotlistImport(Request $request)
    {
          return view('hotlist.import');
    }

    public function hotlistImportStore(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

       // dd($request->file);
        try{
            Excel::import(new ImportHotlist, $request->file);
        }
        catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::alert($e->failures());
        }
       return redirect()->back()
                        ->with('success','Vehicle Added successfully');
    }

    public function numberTracker_bkp()
    {
        $locations = Location::where('deleted_at',null)->whereDate('created_at', Carbon::today())->get();
        return view('hotlist.number',compact('locations'));
    }

      public function numberTracker()
    {
        $locations = Location::where('deleted_at',null)->get();
        return view('hotlist.number',compact('locations'));

      //  $locations = Location::where('deleted_at',null)->whereDate('created_at', Carbon::today())->get();
       // return view('hotlist.number',compact('locations'));
    }





    public function getNumberTracker(Request $request){


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
        $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
            // Fetch records
            $totalRecord = HotRecord::where('deleted_at',null)->whereBetween('created_at', [$today, $tomorrow])->orderBy($columnName,$columnSortOrder);
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();
            $totalRecordswithFilte = HotRecord::where('deleted_at',null)->whereBetween('created_at', [$today, $tomorrow])->orderBy($columnName,$columnSortOrder);
            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();
            $totalRecordswithFilte = HotRecord::where('deleted_at',null)->whereBetween('created_at', [$today, $tomorrow])->orderBy($columnName,$columnSortOrder);

            $items = HotRecord::where('deleted_at',null)->whereBetween('created_at', [$today, $tomorrow])->orderBy($columnName,$columnSortOrder);
            $records = $items->skip($start)->take($rowperpage)->get();

            $data_arr = array();

            foreach($records as $record){
                $id = $record->id;
                $lp_number = $record->regi_no;
                $category = $record->category;
                $make =  $record->make;
                $model =  $record->model;
                $colour =  $record->colour;
                $date =  $record->date;
                $time =  $record->time;
                $location =  $record->location;
                $district =  $record->city;
             $data_arr[] = array(
               "id" => $id,
               "lp_number" => $lp_number,
               "category" => $category,
               "make" => $make,
               "model" => $model,
               "date" => $date,
               "location" => $location,
               "time" => $time,
               "colour" => $colour,
               "district" => $district,
               "edit" => '<div class="settings-main-icon"><a  href="' . url('register-hotlist/'.$id.'/edit') . '"><i class="fe fe-edit-2 bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="si si-trash bg-danger "></i></a></div>'

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

    public function numberLocations(){

        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $datas = HotRecord::where('deleted_at',null)->whereBetween('created_at', [$today, $tomorrow])->get();
      // dd($datas);
        $locations = Location::where('deleted_at',null)->get();
        $test =[];
       // $tt =array();
        foreach($locations as $location){
            foreach($datas as  $data){
                if($data['city'] == $location['city'] && $data['camera_id'] == $location['camera_id'] ){
                   // print_r( $location);
                    $test[] = $location;
                }
            }

        }

        return $test;



    }

    public function dbBackupRecords(){
        $date =date("Y-m-d");

        $newDate =date("Y-m-d");
        $d1= date('Y-m-d', strtotime($newDate. '-10 days'));



        $startDate = Carbon::createFromFormat('Y-m-d',  $d1)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $d1)->endOfDay();
        $table = 'records_'.$d1;
        //dd($table);

        $datas = Records::whereBetween('created_at',[$startDate, $endDate])->limit(1000)->get();
        //dd($datas);
        foreach($datas as $data){
            DB::table($table)->insert([
                'regi_no' => $data['regi_no'],
                'date' => $data['date'],
                'time' => $data['time'],
                'location' => $data['location'],
                'vehicle_dir' => $data['vehicle_dir'],
                'make'=> $data['make'],
                'colour'=> $data['colour'],
                'photo'=> $data['photo'],
                'violation'=> $data['violation'],
                'city'=> $data['city'],
                'lane_name'=> $data['lane_name'],
                'camera_id'=> $data['camera_id'],
                 'created_at'=> $data['created_at']

            ]);
        }




            $headers = array(
                'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Content-Disposition' => 'attachment; filename=abc.csv',
                'Expires' => '0',
                'Pragma' => 'public',
            );

            $filename = "records_".$d1.".csv";
           // $path ='records/';
            $handle = fopen($filename, 'w');
            fputcsv($handle, [
                "Register Number",
                "Date",
                "Time",
                "Location",
                "Vehicle Direction",
                "Make",
                "Colour",
                "Photo",
                "Violation",
                "City",
                "Lane Name",
                "Camera ID",

            ]);

            $items = Records::whereBetween('created_at',[$startDate, $endDate])->limit(1000);
            //$items = Records::query();

            $items->chunk(1000, function ($data) use ($handle) {
                foreach ($data as $row) {
                    // Add a new row with data
                    fputcsv($handle, [
                        $row->regi_no,
                        $row->date,
                        $row->time,
                        $row->location,
                        $row->vehicle_dir,
                        $row->make,
                        $row->colour,
                        $row->photo,
                        $row->violation,
                        $row->city,
                        $row->lane_name,
                        $row->camera_id,

                    ]);
                }
            });
            fclose($handle);

            $datas = Records::whereBetween('created_at',[$startDate, $endDate])->delete();
            return redirect()->back()->with('success','Backup created successfully');



    }
    public function addNotification() {

         $data =  Notification::create([
                            'message' => "KL09A1234 Vehicle Passed to Palayam",
                            'date'    => date("Y-m-d"),
                            'status' =>0

                            ]);
    }

    public function imageDownload(Request $request) {

        $date  = $request->date;
        $id    = $request->id;
        $table = 'records_'.$date;
        $data  = DB::table($table)->where('_id',$id)->first();

        //return($data['regi_no']);
         $data_id = (string)$data['_id'];
         $url   =  $data['photo'];
         $data1 = file_get_contents($url);
         $unique = uniqid();
         $new = 'admin/vehicle_images/'.$unique.'.jpg';
         file_put_contents($new, $data1);


        //return $data;

        $imageDetails =  ImageDownload::create([
                            'data_id' =>$data_id,
                            'regi_no'    =>$data['regi_no'],
                            'date' =>$data['date'],
                            'time' =>$data['time'],
                            'location' =>$data['location'],
                            'vehicle_dir' =>$data['vehicle_dir'],
                            'make' =>$data['make'],
                            'colour' =>$data['colour'],
                            'violation' =>$data['violation'],
                            'photo' =>$unique.'.jpg',
                            'city' =>$data['city'],
                            'lane_name' =>$data['lane_name'],
                            'camera_id' =>$data['camera_id'],
                            ]);
         return response()->json([
                        'success' => 'Image Downloaded successfully.'
                    ]);




        ///return($date ." and id is ".$id);

        /* $data =  Notification::create([
                            'message' => "KL09A1234 Vehicle Passed to Palayam",
                            'date'    => date("Y-m-d"),
                            'status' =>0

                            ]);*/
    }

    






}
