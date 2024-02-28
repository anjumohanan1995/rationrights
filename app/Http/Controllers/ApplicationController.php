<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\User;
use App\District;
use App\State;
use Redirect;
use Auth;
use App\Exports\ExportApplications;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
//use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;



class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('applications.ration-aadhaar-form');
    }


    public function generatePDF()
    {
        // Include the fpdf library
        require_once('fpdf.php');

        // Create instance of FPDF
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Hello, World!');
        $pdf->Output();
        exit;
    }
    public function rationCard()
    {

        $states = State::get();
        return view('admin.applications-form.ration-aadhaar-form',compact('states'));
        // return view('applications.ration-aadhaar-form');
    }
    public function noDocuments()
    {

        $states = State::get();
        return view('admin.applications-form.no-documents-form',compact('states'));
        // return view('applications.no-documents-form');
    }
    public function aadhaar()
    {
        $states = State::get();
        return view('admin.applications-form.aadhaar-form',compact('states'));
        // return view('applications.aadhaar-form');
    }
    public function survey(Request $request)
    {
        $data = $request->all();
        $selectedDistrictId = $request->input('district');
        $selectedLocationId = $request->input('location');
        $district = $request->input('district1');
        $location = $request->input('location1');

        // Store data in the session
        $request->session()->put('selected_district_id', $selectedDistrictId);
        $request->session()->put('selected_location_id', $selectedLocationId);
        $request->session()->put('district_id', $district);
        $request->session()->put('location_id', $location);



        return view('admin.applications-form.form-2',compact('data'));

        // return view('applications.survey',compact('data'));
    }
    public function surveyHome()
    {
        $districts = District::get();
        return view('applications.survey-home',compact('districts'));
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
        if($request->aadhaar !=null){
            $application = Application::where('aadhaar',$request->aadhaar)->where('deleted_at',null)->latest()->first();

        }
        $selectedDistrictId = session('selected_district_id');
        $selectedLocationId = session('selected_location_id');
        $district = session('district_id');
        $location = session('location_id');

        //$count = Application::where('location_id',$location_id)->count();

        $latest_application = Application::where('location_id',$location)->where('deleted_at',null)->latest()->first();

        if($latest_application == null)
        {
            $application_number = $latest_application ? $latest_application->application_no : 0;
            //dd($location);
            $application_number = preg_replace('/[^0-9]/', '', $application_number);
            $application_number++;
            $number = $location . str_pad($application_number, 6, '0', STR_PAD_LEFT);
        }
        else
        {
            $application_number = $latest_application->application_no ;
            $application_number = preg_replace('/[^0-9]/', '', $application_number);
            $application_number++;

            $number =str_pad($application_number, 6, '0', STR_PAD_LEFT);
        }
        // $district = District::find($selectedDistrictId);
        // $location = Location::find($selectedLocationId);
        $customMessages = [
            'aadhaar.unique' => 'The Aadhaar number is already in use. Application No : '.@$application->application_no,
            'aadhaar.regex' => 'The aadhaar number must be a valid 12-digit number.',
            'mobile.regex' => 'The mobile number must be a valid 10-digit number.',
            'ration.regex' => 'The ration card number must be a valid 10-digit number.',
            'age.integer' => 'The age must be a valid number .',
            'age.min' => 'The age must be at least :min.',
            'age.max' => 'The age must not exceed :max.',
            // 'name.regex' => 'The name field should only contain alphabetic characters and spaces.',

        ];
        $validate = Validator::make($request->all(),
            [
                'name' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
                'age' => 'nullable|integer|min:1|max:150',
                'mobile' => ['nullable', 'regex:/^\d{10}$/'],
                'aadhaar' => [
                    'nullable',
                    'regex:/^\d{12}$/',
                    'unique:applications,aadhaar',
                ],
                'ration' => 'nullable',

            ], $customMessages);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        }


        //Application::create($request->all());
        $user = Application::create([
            'type' => $request->type,
            'name' => $request->name,
            'address' => $request->address,
            'age' => $request->age,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
            'years' => $request->years,
            'aadhaar' => $request->aadhaar,
            'ration' => $request->ration,
            'eligibility' => $request->eligibility,
            'district' => $selectedDistrictId,
            'location' =>  $selectedLocationId,
            'home_state' =>$request->home_state,
            'home_district' =>$request->home_district,
            'home_location' =>$request->state,
            'application_no' => @$number,
            'location_id' => $location,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect()->back()
            ->with('success','Application Submitted Successfully. Application No : '.@$number);
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
    public function  districtAadharApplicationLIst()
     {

         $districts = District::get();
         return view('admin.report.aadhar.district_list',compact('districts'));
     }



     public function  getAdhaarGenderApplications(Request $request)
     {
        $gender  =  $request->gender;


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




            // Total records
            $totalRecord = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecord->where('gender',$gender);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecordswithFilte->where('gender',$gender);
            }



            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($gender != ""){
                $items->where('gender',$gender);
            }

            $records = $items->skip($start)->take($rowperpage)->get();




            $data_arr = array();
            $i=0;
            foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');



            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,

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
     public function  genderAadharApplicationLIst()
     {

         $districts = District::get();
         return view('admin.report.aadhar.gender_list',compact('districts'));
     }


     public function  getAdhaarDistrictApplications(Request $request)
     {
        $district  =  $request->district;


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




            // Total records
            $totalRecord = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($district != ""){
                $totalRecord->where('district',$district);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }



            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($district != ""){
                $items->where('district',$district);
            }

            $records = $items->skip($start)->take($rowperpage)->get();




            $data_arr = array();
            $i=0;
            foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');



            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,

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





     public function  agelessApplicationLIst()
     {

         $districts = District::get();
         return view('admin.report.aadhar_ration.ageless_list',compact('districts'));
     }
     public function  getAgeApplications(Request $request)
     {
        // dd($request->from_date ."and  ".$request->to_date );

        $age = $request->age;

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



            // Total records
            $totalRecord = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if ($age!='') {
                // Split the age range if necessary
                if ($age == '0-30') {
                    $totalRecord->where('age', '<=', '30');
                } elseif ($age == '30-50') {
                    $totalRecord->whereBetween('age', ['31', '50']);
                } elseif ($age == '50') {
                    $totalRecord->where('age', '>', '50');
                }
            }


            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if ($age!='') {
                // Split the age range if necessary
                if ($age == '0-30') {
                    $totalRecordswithFilte->where('age', '<=', '30');
                } elseif ($age == '30-50') {
                    $totalRecordswithFilte->whereBetween('age', ['31', '50']);
                } elseif ($age == '50') {
                    $totalRecordswithFilte->where('age', '>', '50');
                }
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if ($age!='') {
                // Split the age range if necessary
                if ($age == '0-30') {
                    //dd("jj");
                    $items->where('age', '<=', '30');
                } elseif ($age == '30-50') {
                    $items->whereBetween('age', ['31', '50']);
                } elseif ($age == '50') {
                    $items->where('age', '>', '50');
                }
            }



            $records = $items->skip($start)->take($rowperpage)->get();




        $data_arr = array();
        $i=$start;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;

            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $state =  @$record->state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');;
            //$role  =  $record$mobile  =  $request->mobile;


            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'state '=>@$state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,


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


     public function  districtApplicationLIst()
     {

         $districts = District::get();
         return view('admin.report.aadhar_ration.district_list',compact('districts'));
     }

     public function  getDistrictApplications(Request $request)
     {
        $district  =  $request->district;




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




            // Total records
            $totalRecord = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');

            if($district != ""){
                $totalRecord->where('district',$district);
            }



            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');

            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }



            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);

            if($district != ""){
                $items->where('district',$district);
            }



            $records = $items->skip($start)->take($rowperpage)->get();




        $data_arr = array();
        $i=$start;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;

            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $state =  @$record->state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');;
            //$role  =  $record$mobile  =  $request->mobile;


            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'state '=>@$state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,


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








     public function  genderApplicationLIst()
     {

         $districts = District::get();
         return view('admin.report.aadhar_ration.gender_list',compact('districts'));
     }
     public function  getGenderApplications(Request $request)
     {
        // dd($request->from_date ."and  ".$request->to_date );

        $gender = $request->gender;

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
            $totalRecord = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecord->where('gender',$gender);
            }


            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecordswithFilte->where('gender',$gender);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($gender != ""){
                $items->where('gender',$gender);
            }



            $records = $items->skip($start)->take($rowperpage)->get();
        }



        $data_arr = array();
        $i=$start;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;

            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $state =  @$record->state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');;
            //$role  =  $record$mobile  =  $request->mobile;


            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'state '=>@$state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,


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


    public function applicationLIst()
     {

         $districts = District::get();
         return view('admin.applications.index',compact('districts'));
     }
    public function getApplications(Request $request){
        // dd($request->from_date ."and  ".$request->to_date );
        $district  =  $request->district;
        $location  =  $request->location;
        $application_no = $request->application_no;
        if ($request->from_date != '') {

            $from_date = date("M d,Y", strtotime($request->from_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->to_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->to_date));
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




            // Total records
            $totalRecord = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecord->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecord->where('district',$district);
            }
            if ($location != "") {
                $totalRecord->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecordswithFilte->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }
            if ($location != "") {
                $totalRecordswithFilte->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($application_no != ""){
                $items->where('application_no',$application_no);
            }
            if($district != ""){
                $items->where('district',$district);
            }
            if ($location != "") {
                $items->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "")
            {
                //dd($stDate."hiii".$edDate);

                $items->whereBetween('created_at', [$stDate, $edDate]);
            }


            $records = $items->skip($start)->take($rowperpage)->get();




        $data_arr = array();
        $i=$start;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;

            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $state =  @$record->state;
            $home_district =  $record->home_district;
            $home_state =  $record->home_state;

            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');;
            //$role  =  $record$mobile  =  $request->mobile;

            // if($record->deleted_at != null){
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
            //     $change = '';

            // }else{
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
            //     $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


            // }

            $view ='<a  href="' . url('application-list/'.$id.'/view') . '"><i class="fa fa-eye bg-info me-1"></i></a>';
            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'state '=>@$state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,
                'home_state'=>$home_state,
                'view'=>$view


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

    public function applicationLIstView($id)
    {
        $data = Application::where('_id',$id)->first();
        return view('admin.applications.view_aadhar_ration',compact('data'));
    }


    public function exportPdf(Request $request)
    {

        $applicationNo = $request->input('application_number');
        $districts = $request->input('dist');
        $locate = $request->input('locations');

        if ($request->start_date != '') {

            $from_date = date("M d,Y", strtotime($request->start_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->ending_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->ending_date));
            $edDate = new Carbon($to_date);
        }

         // Your existing code to fetch data from the database
         $records = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');


        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $records->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($applicationNo != ""){
            $records->where('application_no',$applicationNo);
        }
        if($districts != ""){

            $records->where('district',$districts);
        }
        if($locate != "" ){
            $records->where('location',$locate);
        }
        $records = $records->get();





            // Generate PDF content
            $pdfContent = view('pdf.ration_aadhaar_applications', compact('records'))->render();

            // Generate PDF file
            $pdf = SnappyPdf::loadHTML($pdfContent);
            $pdf->setOption('encoding', 'UTF-8'); // Optional: Set encoding
            $pdf->setOption('footer-right', 'Page [page] of [topage]'); // Optional: Add footer
            //$pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            // Return PDF as download
            return $pdf->download('ration-aadhaar-applications.pdf');
    }

    private function getSearchResults($searchQuery)
    {

       $data = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->get();
        // Fetch search-based results from the database or any other source
        // You can implement your own logic to fetch the results
        // For demonstration, let's assume it returns an array of search results
        return $data;
    }









    public function adhaarApplicationLIst()
    {
        $districts = District::get();
        return view('admin.applications.adhaar_applications',compact('districts'));
    }
    public function getAdhaarApplications(Request $request){
        $application_no  =  $request->application_no;
        $district  =  $request->district;
        $location  =  $request->location;
        if ($request->from_date != '') {

            $from_date = date("M d,Y", strtotime($request->from_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->to_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->to_date));
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




            // Total records
            $totalRecord = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecord->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecord->where('district',$district);
            }
            if ($location != "") {
                $totalRecord->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
            }
            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecordswithFilte->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }
            if ($location != "") {
                $totalRecordswithFilte->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($application_no != ""){
                $items->where('application_no',$application_no);
            }
            if($district != ""){
                $items->where('district',$district);
            }
            if ($location != "") {
                $items->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $items->whereBetween('created_at', [$stDate, $edDate]);
            }
            $records = $items->skip($start)->take($rowperpage)->get();




        $data_arr = array();
        $i=0;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            //$aadhaar =  $record->aadhaar;
            $aadhaar=$record->aadhaar = '**** ****  ' . substr($record->aadhaar, -4);
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $years =  $record->years;
            $date =  $record->created_at->format('Y-m-d');


            //$role  =  $record->role;
            // if($record->deleted_at != null){
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
            //     $change = '';

            // }else{
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
            //     $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


            // }

            $view ='<div class="settings-main-icon"><a  href="' . url('adhaar-application-list/'.$id.'/view') . '"><i class="fa fa-eye bg-info me-1"></i></a><a  href="' . url('adhaar-application-list/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a></div>';

            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>$years,
                'date'=>$date,
                'view'=>$view,


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
    public function adhaarApplicationLIstView($id){
        $data = Application::where('_id',$id)->first();
        return view('admin.applications.view_aadhar',compact('data'));


    }

    public function  adhaarApplicationEdit($id){
        $data = Application::where('_id',$id)->first();
        return view('admin.applications.edit_aadhar',compact('data'));



    }

    public function  adhaarApplicationUpdate(Request $request){
        dd($request);
    }




    public function adhaarRationApplicationLIst()
    {
        $districts = District::get();
        return view('admin.applications.adhaar_ration_applications',compact('districts'));
    }
    public function getAdhaarRationApplications(Request $request){

        $application_no  =  $request->application_no;
        $district  =  $request->district;
        $location  =  $request->location;
        if ($request->from_date != '') {

            $from_date = date("M d,Y", strtotime($request->from_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->to_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->to_date));
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



            // Total records
            $totalRecord = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecord->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecord->where('district',$district);
            }
            if ($location != "") {
                $totalRecord->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($application_no != ""){
                $totalRecordswithFilte->where('application_no',$application_no);
            }
            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }
            if ($location != "") {
                $totalRecordswithFilte->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($application_no != ""){
                $items->where('application_no',$application_no);
            }
            if($district != ""){
                $items->where('district',$district);
            }
            if ($location != "") {
                $items->where('location_id', $location);
            }

            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $items->whereBetween('created_at', [$stDate, $edDate]);
            }


            $records = $items->skip($start)->take($rowperpage)->get();




        $data_arr = array();
        $i=0;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            $aadhaar =  $record->aadhaar;
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format('Y-m-d');
            $years =  @$record->years;

            //$role  =  $record->role;
            // if($record->deleted_at != null){
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
            //     $change = '';

            // }else{
            //     $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
            //     $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


            // }

            $view ='<div class="settings-main-icon"><a  href="' . url('noadhaar-noration-application-list/'.$id.'/view') . '"><i class="fa fa-eye bg-info me-1"></i></a>&nbsp;&nbsp;<a  href="' . url('noadhaar-noration-application-list/'.$id.'/edit') . '"><i class="fas fa-edit bg-info me-1"></i></a></div>';



            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>@$years,
                'date'=>$date,
                'view'=>$view


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


    public function noadhaarNorationApplicationLIstView( $id){
        $data = Application::where('_id',$id)->first();
        return view('admin.applications.view_noaadhar_noration',compact('data'));
    }
    public function noadhaarNorationApplicationLIstEdit($id)    {
       $data = Application::where('_id',$id)->first();
        return view('admin.applications.edit_noaadhar_noration',compact('data'));
    }
    public function noadhaarNorationApplicationLIstUpdate(Request $request,$id){


        $validate = Validator::make($request->all(),
        [
            'aadhar' => [
                'required',
                'digits:12',

            ],


    ]);
    if ($validate->fails()) {
         return Redirect::back()->withErrors($validate)->withInput();
        /*return response()->json([
                    'error' => $validate->errors()->all()
                ]);*/

    }
    $aadhar = $request->input('aadhar');
    $existingRecord = Application::where('aadhaar', $aadhar)->where('_id', '!=', $id)->first();

    if ($existingRecord) {

        return redirect()->back()->withErrors(['aadhar' => 'The Aadhaar number is already in use. Application No : '.@$existingRecord->application_no])->withInput();
    }

        $data = Application::where('_id',$id)->first();
        $type="";
        if($request->aadhar !="" && $request->ration !=""){
            $type="ration-aadhaar-form";
        }
        elseif($request->aadhar !="" && $request->ration ==""){
            $type="aadhaar-form";
        }
        else{
            $type=$request->old_type;
        }
        $data->update([
            'ration' =>$request->ration,
            'aadhaar' =>$request->aadhar,
            'old_type' =>$request->old_type,
            'updated_by' => Auth::user()->id,
            'type'=>$type,
        ]);
        return redirect()->back()
        ->with('success','Application Updated Successfully');
    }
    public function add()
    {
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'role' => 'Admin',
        //     'password' => Hash::make('12345678')
        // ]);
        Application::where('_id','!=',null)->delete();
    }
    public function getLocations(Request $request){

        $district = $request->district_id;
        $data =District::where('_id',$district)->select('name','locations','district_id')->first();
        return response()->json($data);
    }
    public function states()
    {
        $indianStates = [
            'AP' => 'Andhra Pradesh',
            'AR' => 'Arunachal Pradesh',
            'AS' => 'Assam',
            'BR' => 'Bihar',
            'CT' => 'Chhattisgarh',
            'GA' => 'Goa',
            'GJ' => 'Gujarat',
            'HR' => 'Haryana',
            'HP' => 'Himachal Pradesh',
            'JK' => 'Jammu and Kashmir',
            'JH' => 'Jharkhand',
            'KA' => 'Karnataka',
            'KL' => 'Kerala',
            'MP' => 'Madhya Pradesh',
            'MH' => 'Maharashtra',
            'MN' => 'Manipur',
            'ML' => 'Meghalaya',
            'MZ' => 'Mizoram',
            'NL' => 'Nagaland',
            'OR' => 'Odisha',
            'PB' => 'Punjab',
            'RJ' => 'Rajasthan',
            'SK' => 'Sikkim',
            'TN' => 'Tamil Nadu',
            'TG' => 'Telangana',
            'TR' => 'Tripura',
            'UP' => 'Uttar Pradesh',
            'UT' => 'Uttarakhand',
            'WB' => 'West Bengal',
            'AN' => 'Andaman and Nicobar Islands',
            'CH' => 'Chandigarh',
            'DN' => 'Dadra and Nagar Haveli',
            'DD' => 'Daman and Diu',
            'LD' => 'Lakshadweep',
            'DL' => 'National Capital Territory of Delhi',
            'PY' => 'Puducherry'
        ];

        foreach ($indianStates as $code => $name) {
            State::create([
                'name' => $name

            ]);
        }
    }




    public function district()
    {
        District::create([
            'name'=> 'Thiruvananthapuram',
            'district_id' =>  1,
            'locations' => [
                ['name' => 'Chirayinkeezhu','location_id' => 4],
                ['name' => 'CRO-North-Thiruvananthapuram','location_id' => 2],
                ['name' => 'CRO-South-Thiruvananthapuram','location_id' => 1],
                ['name' => 'Kattakada','location_id' => 70],
                ['name' => 'Nedumangad','location_id' => 5],
                ['name' => 'Neyyattinkara','location_id' => 6],
                ['name' => 'TSO_Thiruvananthapuram','location_id' => 3],
                ['name' => 'Varkala','location_id' => 71],

            ]

        ]);
        District::create([
            'name'=> 'Kollam',
            'district_id' =>  2,
            'locations' => [
                ['name' => 'Karunagappally','location_id' => 10],
                ['name' => 'Kollam','location_id' => 7],
                ['name' => 'Kottarakkara','location_id' => 8],
                ['name' => 'Kunnathoor','location_id' => 11],
                ['name' => 'Pathanapuram','location_id' => 9],
                ['name' => 'Punalur','location_id' => 72],
            ]

        ]);

        District::create([
            'name'=> 'Pathanamthitta',
            'district_id' =>  3,
            'locations' => [
                ['name' => 'Adoor','location_id' =>14 ],
                ['name' => 'Konni','location_id' =>73],
                ['name' => 'Kozhenchery','location_id' =>12 ],
                ['name' => 'Mallappally','location_id' =>16 ],
                ['name' => 'Ranni','location_id' =>15 ],
                ['name' => 'Thiruvalla','location_id' =>13 ],
            ]

        ]);
        District::create([
            'name'=> 'Alappuzha',
            'district_id' =>  4,
            'locations' => [
                ['name' => 'Ambalapuzha','location_id' =>18 ],
                ['name' => 'Chengannur','location_id' =>22],
                ['name' => 'Cherthala','location_id' =>17 ],
                ['name' => 'Karthikappally','location_id' =>20 ],
                ['name' => 'Kuttanad','location_id' =>19 ],
                ['name' => 'Mavelikkara','location_id' =>21 ],
            ]

        ]);

        District::create([
            'name'=> 'Kottayam',
            'district_id' =>  5,
            'locations' => [
                ['name' => 'Changanachery','location_id' =>24 ],
                ['name' => 'Kanjirappally','location_id' =>26],
                ['name' => 'Kottayam','location_id' =>23 ],
                ['name' => 'Meenachil','location_id' =>27 ],
                ['name' => 'Vaikom','location_id' =>25 ],
            ]

        ]);
        District::create([
            'name'=> 'Idukki',
            'district_id' =>  6,
            'locations' => [
                ['name' => 'Devikulam','location_id' =>29 ],
                ['name' => 'Idukki','location_id' =>74],
                ['name' => 'Peerumedu','location_id' =>31 ],
                ['name' => 'Thodupuzha','location_id' =>28 ],
                ['name' => 'Udumbanchola','location_id' =>30 ],
            ]

        ]);
        District::create([
            'name'=> 'Ernakulam',
            'district_id' =>  7,
            'locations' => [
                ['name' => 'Aluva','location_id' =>36 ],
                ['name' => 'CRO_Ernakulam','location_id' =>32],
                ['name' => 'CRO_kochi','location_id'=>33],
                ['name' => 'Kanayannoor','location_id' =>34 ],
                ['name' => 'Kothamangalam','location_id' =>39 ],
                ['name' => 'Kunnathunadu','location_id' =>38 ],
                ['name' => 'Moovattupuzha','location_id' =>40],
                ['name' => 'North_Paravoor','location_id' =>37 ],
                ['name' => 'TSO_Kochi','location_id' =>35 ],

            ]

        ]);
        District::create([
            'name'=> 'Thrissur',
            'district_id' =>  8,
            'locations' => [
                ['name' => 'Chalakkudy','location_id' =>75 ],
                ['name' => 'Chavakkad','location_id' =>44],
                ['name' => 'Kodungalloor','location_id' =>45 ],
                ['name' => 'Kunnamkulam','location_id' =>82 ],
                ['name' => 'Mukundapuram','location_id' =>43 ],
                ['name' => 'Thalappilly','location_id' =>42 ],
                ['name' => 'Thrissur','location_id' =>41],


                ]

        ]);
        District::create([
            'name'=> 'Palakkad',
            'district_id' =>  9,
            'locations' => [
                ['name' => 'Alathur','location_id' =>50 ],
                ['name' => 'Chittur','location_id' =>47],
                ['name' => 'Mannarkad','location_id' =>49 ],
                ['name' => 'Ottappalam','location_id' =>48 ],
                ['name' => 'Palakkad','location_id' =>46 ],
                ['name' => 'Pattambi','location_id' =>76 ],



                ]

        ]);
        District::create([
            'name'=> 'Malappuram',
            'district_id' =>  10,
            'locations' => [
                ['name' => 'Ernad','location_id' =>51 ],
                ['name' => 'Kondotty','location_id' =>77],
                ['name' => 'Nilambur','location_id' =>52 ],
                ['name' => 'Perinthalmanna','location_id' =>53 ],
                ['name' => 'Ponnani','location_id' =>56 ],
                ['name' => 'Thirur','location_id' =>54 ],
                ['name' => 'Thirurangadi','location_id' =>55 ],




                ]

        ]);
        District::create([
            'name'=> 'Kozhikkodu',
            'district_id' =>  11,
            'locations' => [
                ['name' => 'CRO_North_Kozhikkode','location_id' =>57 ],
                ['name' => 'CRO_South_Kozhikkode','location_id' =>58],
                ['name' => 'Koyilandi','location_id' =>60 ],
                ['name' => 'Thamarassery','location_id' =>78 ],
                ['name' => 'TSO_Kozhikkode','location_id' =>59 ],
                ['name' => 'Vadakara','location_id' =>61 ],





                ]

        ]);
        District::create([
            'name'=> 'Wayanad',
            'district_id' =>  12,
            'locations' => [
                ['name' => 'Mananthavady','location_id' =>64 ],
                ['name' => 'Sulthan Batheri','location_id' =>63],
                ['name' => 'Vythiri','location_id' =>62 ],

            ]

        ]);
        District::create([
            'name'=> 'Kannur',
            'district_id' =>  13,
            'locations' => [
                ['name' => 'Iritty','location_id' =>79 ],
                ['name' => 'Kannur','location_id' =>66],
                ['name' => 'Payyannur','location_id' =>83 ],
                ['name' => 'Thalassery','location_id' =>67 ],
                ['name' => 'Thaliparambu','location_id' =>65 ],

            ]

        ]);
        District::create([
            'name'=> 'Kasargodu',
            'district_id' =>  14,
            'locations' => [
                ['name' => 'Hosdurg','location_id' =>69 ],
                ['name' => 'Kasaragod','location_id' =>68],
                ['name' => 'Manjeswaram','location_id' =>81 ],
                ['name' => 'Vellarikundu','location_id' =>80 ],

            ]

        ]);
    }
    public function exportAadhaarOnly(Request $request)
    {
        $applicationNo = $request->input('application_number');
        $districts = $request->input('dist');
        $locate = $request->input('locations');

        if ($request->start_date != '') {

            $from_date = date("Y-m-d", strtotime($request->start_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->ending_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->ending_date));
            $edDate = new Carbon($to_date);
        }

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=abc.xlsx',
            'Expires' => '0',
            'Pragma' => 'public',
        );

        $filename = "applications.csv";
        $handle = fopen($filename, 'w');

        fputcsv($handle, [

            "Application No.",
            "Name",
            "Aadhaar No.",
            "Mobile No.",
            "Gender",
            "Since when staying in Kerala",

            "Home District",
            "Eligible for IMPDS or Not",


            "District",
            "Location",
            "Created Date"

        ]);

        $items = Application::where('type','aadhaar-form')
        ->where('deleted_at',null);

        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $items->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($applicationNo != ""){
            $items->where('application_no',$applicationNo);
        }
        if($districts != ""){

            $items->where('district',$districts);
        }
        if($locate != "" ){
            $items->where('location',$locate);
        }
        $records = $items->get();

        $data_arr = array();
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $mobile = $record->mobile;
            $application_no = $record->application_no;
            $gender = $record->gender;
            $years = $record->years;
            $state = $record->state;
            $home_district = $record->home_district;
            $eligibility =  $record->eligibility;
            $aadhar =  $record->aadhaar;
            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format('Y-m-d');

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "mobile" => $mobile,
                "application_no" => $application_no,
                "aadhar" => $aadhar,
                "gender" => $gender,
                "years" => $years,
                "state" => $state,
                "home_district" => $home_district,
                "eligibility" => $eligibility,

                "district"=>$district,
                "location"=>$location,
                "date"=>$date,
            );
        }

        foreach ($data_arr as $each_user) {

            fputcsv($handle, [
                $each_user['application_no'],
                $each_user['name'],
                $each_user['aadhar'],
                $each_user['mobile'],
                $each_user['gender'],
                $each_user['years'],
                // $each_user['state'],
                $each_user['home_district'],
                $each_user['eligibility'],
                $each_user['district'],
                $each_user['location'],
                $each_user['date'],

            ]);

        }
        fclose($handle);

        return response()->download($filename, "aadhar-applications.xlsx", $headers);


    }
    public function exportRation(Request $request)
    {
        $applicationNo = $request->input('application_number');
        $districts = $request->input('dist');
        $locate = $request->input('locations');

        if ($request->start_date != '') {

            $from_date = date("M d,Y", strtotime($request->start_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->ending_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->ending_date));
            $edDate = new Carbon($to_date);
        }

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=abc.xlsx',
            'Expires' => '0',
            'Pragma' => 'public',
        );

        $filename = "applications.csv";
        $handle = fopen($filename, 'w');

        fputcsv($handle, [

            "Application No.",
            "Name",
            "Address",
            "Age",


            "Mobile No.",
            "Gender",

            "Since when staying in Kerala",
            "Aadhaar No.",
            "Ration Card No.",
            "Eligible for IMPDS or Not",
            "District",
            "Location",
            "Created Date"

        ]);


        $items = Application::where('type','ration-aadhaar-form')
        ->where('deleted_at',null);

        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $items->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($applicationNo != ""){
            $items->where('application_no',$applicationNo);
        }
        if($districts != ""){

            $items->where('district',$districts);
        }
        if($locate != "" ){
            $items->where('location',$locate);
        }
        $records = $items->get();
        $data_arr = array();
        foreach($records as $record){
            //dd($record);
            $id = $record->id;
            $name = $record->name;
            $mobile = $record->mobile;
            $application_no = $record->application_no;
            $gender = $record->gender;
            $years = $record->years;
            //$state = $record->state;
            // $home_district = $record->home_district;
            $eligibility =  $record->eligibility;
            $aadhar =  $record->aadhaar;

            $address =  $record->address;
            $age =  $record->age;
            $ration =  $record->ration;
            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format('Y-m-d');

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "mobile" => $mobile,
                "application_no" => $application_no,
                "aadhar" => $aadhar,
                "gender" => $gender,
                "years" => $years,
                "age" => $age,
                "address" => $address,
                "eligibility" => $eligibility,

                "ration" => $ration,
                "district"=>$district,
                "location"=>$location,
                "date"=>$date
            );
        }

        foreach ($data_arr as $each_user) {

            fputcsv($handle, [
                $each_user['application_no'],
                $each_user['name'],
                $each_user['address'],
                $each_user['age'],
                $each_user['mobile'],
                $each_user['gender'],
                $each_user['years'],
                $each_user['aadhar'],
                $each_user['ration'],

                $each_user['eligibility'],
                $each_user['district'],
                $each_user['location'],
                $each_user['date']
            ]);

        }


        fclose($handle);

        return response()->download($filename, "ration-aadhaar-applications.xlsx", $headers);


    }
    public function exportNodoc(Request $request)
    {
        $applicationNo = $request->input('application_number');
        $districts = $request->input('dist');
        $locate = $request->input('locations');
        $gender = $request->input('gen');

        if ($request->start_date != '') {

            $from_date = date("M d,Y", strtotime($request->start_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->ending_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->ending_date));
            $edDate = new Carbon($to_date);
        }

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=abc.xlsx',
            'Expires' => '0',
            'Pragma' => 'public',
        );

        $filename = "applications.csv";
        $handle = fopen($filename, 'w');

        fputcsv($handle, [

            "Application No.",
            "Name",
            "Address",

            "Mobile No.",
            "Gender",
            "Since when staying in Kerala",

            "Home District",
            "District",
            "Location",
            "Created Date"


        ]);


        $items = Application::where('type','no-documents-form')
        ->where('deleted_at',null);

        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $items->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($applicationNo != ""){
            $items->where('application_no',$applicationNo);
        }
        if($gender != ""){

            $items->where('gender',$gender);
        }
        if($districts != ""){

            $items->where('district',$districts);
        }
        if($locate != "" ){
            $items->where('location',$locate);
        }
        $records = $items->get();


        $data_arr = array();
        foreach($records as $record){

            $id = $record->id;
            $name = $record->name;
            $mobile = $record->mobile;
            $application_no = $record->application_no;
            $gender = $record->gender;
            $years = $record->years;
            $state = $record->state;
            $home_district = $record->home_district;
            $eligibility =  $record->eligibility;
            $aadhar =  $record->aadhaar;
            $address =  $record->address;

            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format("Y-m-d");




            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "mobile" => $mobile,
                "application_no" => $application_no,
                "aadhar" => $aadhar,
                "gender" => $gender,
                "years" => $years,
                "state" => $state,
                "home_district" => $home_district,
                "address"=>$address,

                "district"=>$district,
                "location"=>$location,
                "date"=>$date


            );
        }

        foreach ($data_arr as $each_user) {

            fputcsv($handle, [
                $each_user['application_no'],
                $each_user['name'],
                $each_user['address'],
                // $each_user['aadhar'],
                $each_user['mobile'],
                $each_user['gender'],
                $each_user['years'],

                $each_user['home_district'],

                $each_user['district'],
                $each_user['location'],
                $each_user['date'],


            ]);

        }


        fclose($handle);

        return response()->download($filename, "no-aadhaar-ration-applications.xlsx", $headers);


    }

    public function destroy(Request $request)
    {
        $application_no = ['4000102','4000103','4000104','4000105','4000106','4000107','4000108'];
        $records = Application::whereIn('application_no', $application_no)->delete();
    }

    public function noAdhaarGenderRationApplicationLIst()
    {
        $districts = District::get();
        return view('admin.report.no_aadhar_ration.gender_list',compact('districts'));
    }
    public function getNoAdhaarRationApplications(Request $request){

        //$application_no  =  $request->application_no;
        $gender  =  $request->gender;
        if ($request->from_date != '') {

            $from_date = date("M d,Y", strtotime($request->from_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->to_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->to_date));
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
            $totalRecord = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecord->where('gender',$gender);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($gender != ""){
                $totalRecordswithFilte->where('gender',$gender);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($gender != ""){
                $items->where('gender',$gender);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $items->whereBetween('created_at', [$stDate, $edDate]);
            }


            $records = $items->skip($start)->take($rowperpage)->get();
        }



        $data_arr = array();
        $i=0;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            $aadhaar =  $record->aadhaar;
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format('Y-m-d');
            $years =  @$record->years;

            //$role  =  $record->role;
            if($record->deleted_at != null){
                $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
                $change = '';

            }else{
                $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
                $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


            }
            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>@$years,
                'date'=>$date


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
    public function  noAdhaarDistrictApplicationLIst()
    {

        $districts = District::get();
        return view('admin.report.no_aadhar_ration.district_list',compact('districts'));
    }



    public function getNoAdhaarDistrictApplications(Request $request){

        //$application_no  =  $request->application_no;
        $district  =  $request->district;
        if ($request->from_date != '') {

            $from_date = date("M d,Y", strtotime($request->from_date));
            $stDate = new Carbon($from_date);
        }
        if ($request->to_date != '') {
            $to_date = date("Y-m-d 23:59:00", strtotime($request->to_date));
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
            $totalRecord = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($district != ""){
                $totalRecord->where('district',$district);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecord->whereBetween('created_at', [$stDate, $edDate]);
            }

            $totalRecords = $totalRecord->select('count(*) as allcount')->count();


            $totalRecordswithFilte = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
            if($district != ""){
                $totalRecordswithFilte->where('district',$district);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $totalRecordswithFilte->whereBetween('created_at', [$stDate, $edDate]);
            }


            $totalRecordswithFilter = $totalRecordswithFilte->select('count(*) as allcount')->count();

            // Fetch records
            $items = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
            if($district != ""){
                $items->where('district',$district);
            }


            if ($request->from_date != "1970-01-01" && $request->to_date != "1970-01-01" && $request->from_date != "" && $request->to_date != "") {

                $items->whereBetween('created_at', [$stDate, $edDate]);
            }


            $records = $items->skip($start)->take($rowperpage)->get();
        }



        $data_arr = array();
        $i=0;
        foreach($records as $record){
            $i++;
            $id = $record->id;
            $name = $record->name;
            $address =  $record->address;
            $age =  $record->age;
            $gender =  $record->gender;
            $mobile =  $record->mobile;
            $application_no =  $record->application_no;
            //$address =  $record->address;
            $aadhaar =  $record->aadhaar;
            $ration =  $record->ration;
            $eligibility =  $record->eligibility;
            $home_state =  $record->home_state;
            $home_district =  $record->home_district;
            $district =  $record->district;
            $location =  $record->location;
            $date =  $record->created_at->format('Y-m-d');
            $years =  @$record->years;

            //$role  =  $record->role;
            if($record->deleted_at != null){
                $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/restore') . '"><button class="btn-btn-primary">Restore</button></a></div>';
                $change = '';

            }else{
                $edit = '<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/edit') . '"><i class="fa fa-edit bg-info me-1"></i></a>&nbsp;&nbsp;<a class="deleteItem" data-id="'.$id.'"><i class="fa fa-trash bg-danger "></i></a></div>';
                $change ='<div class="settings-main-icon"><a  href="' . url('user-management/'.$id.'/changepassword') . '"><i class="fa fa-key bg-info me-1"></i></a></div>';


            }
            $data_arr[] = array(
                "id" => $i,
                "name" => $name,
                "address" => $address,
                "age" => $age,
                "gender" => $gender,
                "application_no" => $application_no,
                "mobile"=>$mobile,
                'aadhaar'=>$aadhaar,
                'ration'=>$ration,
                'eligibility'=>$eligibility,
                'home_state'=>$home_state,
                'home_district'=>$home_district,
                'district'=>$district,
                'location'=>$location,
                'years'=>@$years,
                'date'=>$date


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

}
