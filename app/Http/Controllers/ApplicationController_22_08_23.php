<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\User;
use App\District;
use Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
    public function rationCard()
    {
        return view('applications.ration-aadhaar-form');
    }
    public function noDocuments()
    {
        return view('applications.no-documents-form');
    }
    public function aadhaar()
    {
        return view('applications.aadhaar-form');
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
        return view('applications.survey',compact('data'));
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
            'home_district' =>$request->home_district,
            'home_location' =>$request->state,
            'application_no' => @$number,
            'location_id' => $location
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
    public function destroy($id)
    {
        //
    }

     public function getApplications(Request $request){

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
                $totalRecord = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
                if($mobile != ""){
                    $totalRecord->where('mobile','like',"%".$mobile."%");
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


                $totalRecordswithFilte = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');

                if($mobile != ""){
                    $totalRecordswithFilte->where('mobile','like',"%".$mobile."%");
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
                $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
                if($mobile != ""){
                    $items->where('mobile','like',"%".$mobile."%");
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

                $aadhaar =  $record->aadhaar;
                $ration =  $record->ration;
                $eligibility =  $record->eligibility;
                $state =  $record->state;
                $home_district =  $record->home_district;
                $district =  $record->district;
                $location =  $record->location;

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
                    'state '=>$state,
                   'home_district'=>$home_district,
                    'district'=>$district,
                    'location'=>$location,

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
        return view('admin.applications.index');
    }
        public function adhaarApplicationLIst()
    {
        return view('admin.applications.adhaar_applications');
    }
         public function getAdhaarApplications(Request $request){

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
                $totalRecord = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
                if($mobile != ""){
                    $totalRecord->where('mobile','like',"%".$mobile."%");
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


                $totalRecordswithFilte = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');

                if($mobile != ""){
                    $totalRecordswithFilte->where('mobile','like',"%".$mobile."%");
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
                $items = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
                if($mobile != ""){
                    $items->where('mobile','like',"%".$mobile."%");
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
                $state =  $record->state;
                $home_district =  $record->home_district;
                $district =  $record->district;
                $location =  $record->location;

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
                    'state '=>$state,
                   'home_district'=>$home_district,
                    'district'=>$district,
                    'location'=>$location,

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

            public function adhaarRationApplicationLIst()
    {
        return view('admin.applications.adhaar_ration_applications');
    }
         public function getAdhaarRationApplications(Request $request){

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
                $totalRecord = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');
                if($mobile != ""){
                    $totalRecord->where('mobile','like',"%".$mobile."%");
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


                $totalRecordswithFilte = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc');

                if($mobile != ""){
                    $totalRecordswithFilte->where('mobile','like',"%".$mobile."%");
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
                $items = Application::where('type','no-documents-form')->where('deleted_at',null)->orderBy('created_at','desc')->orderBy($columnName,$columnSortOrder);
                if($mobile != ""){
                    $items->where('mobile','like',"%".$mobile."%");
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
                $state =  $record->state;
                $home_district =  $record->home_district;
                $district =  $record->district;
                $location =  $record->location;

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
                    'state '=>$state,
                   'home_district'=>$home_district,
                    'district'=>$district,
                    'location'=>$location,

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
                ['name' => 'CRO_kochi','location_id' =>33 ],
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
}
