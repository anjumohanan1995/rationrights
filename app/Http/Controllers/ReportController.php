<?php

namespace App\Http\Controllers;

use App\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Excel;
use DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Auth;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function exportApplicationReport(Request $request) {
        $gender_data = $request->input('gender_data');
        $age_data = $request->input('age_data');
        $district_data =$request->input('district_data');
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

        $role=Auth::user()->role;
       // $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null);

       $items = Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
       if($role=='Civil Supplies District User' || $role=='District Chief' || $role =='District Labour Officer'){
           $items->where('district',Auth::user()->district);


        }
        elseif($role=='Civil Supplies Taluk User'){
         //   $items = Application::where('type','no-documents-form')->where('deleted_at',null)->where('location',Auth::user()->taluk)->orderBy('created_at','desc');
         $items->where('location',Auth::user()->taluk);


        }
        elseif($role=='DGP' || $role=='State UT User'  || $role=='Labour Commissioner'){

           $items->where('home_state',Auth::user()->state);

        }

        if ($age_data!='') {
            // Split the age range if necessary
            if ($age_data == '0-30') {
                $items->where('age', '<=', '30');
            } elseif ($age_data == '30-50') {
                $items->whereBetween('age', ['31', '50']);
            } elseif ($age_data == '50') {
                $items->where('age', '>', '50');
            }
        }
        if($district_data != ""){
            $items->where('district',$district_data);
        }

        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $items->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($gender_data != ""){
            $items->where('gender',$gender_data);
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

        return response()->download($filename, "ration-aadhaar-applications-report.xlsx", $headers);


    }

    public function exportApplicationReportAdhar(Request $request) {
        $gender_data = $request->input('gender_data');

        $district_data =$request->input('district_data');
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

        $role=Auth::user()->role;

        //$items = Application::where('type','aadhaar-form')->where('deleted_at',null);
        $items = Application::where('type','aadhaar-form')->where('deleted_at',null)->orderBy('created_at','desc');
            
        if($role=='Civil Supplies District User' || $role=='District Chief' || $role =='District Labour Officer'){
            $items->where('district',Auth::user()->district);


          }
          elseif($role=='Civil Supplies Taluk User'){
           //   $totalRecord = Application::where('type','no-documents-form')->where('deleted_at',null)->where('location',Auth::user()->taluk)->orderBy('created_at','desc');
              $items->where('location',Auth::user()->taluk);


          }
          elseif($role=='DGP' || $role=='State UT User'  || $role=='Labour Commissioner'){

              $items->where('home_state',Auth::user()->state);

          }




        if($district_data != ""){
            $items->where('district',$district_data);
        }

        if ($request->start_date != "1970-01-01" && $request->ending_date != "1970-01-01" && $request->start_date != "" && $request->ending_date != "")
        {
            $items->whereBetween('created_at', [$stDate, $edDate]);
        }
        if($gender_data != ""){
            $items->where('gender',$gender_data);
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

        return response()->download($filename, "ration-aadhaar-applications-report.xlsx", $headers);


    }



     public function index()
    {
        //
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

    public function createPDF(Request $request) {
//         $users =  Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->get();
// $Info = array();

// foreach ($users as $user) {
//     array_push($Info, $user->toArray());
// }

// // Debugging: Dump and die to check contents of $Info
// // /dd($Info);

// view()->share('data', $Info);
// $pdf = PDF::loadView('pdf.example', $Info);
// $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

// return $pdf->download('pdf_file.pdf');




$items =  Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->get();



	    $data = [
	            'title' => 'How To Create PDF File Using DomPDF In Laravel 9 - Techsolutionstuff',
	            'date' => date('d/m/Y'),
	            'users' => $items
	    ];


	        $pdf = PDF::loadView('pdf.example',$data);
	        return $pdf->download('users_pdf_example.pdf');

    //    // $users = User::all();

    // $pdf = PDF::loadView('pdf.example', compact('items'));

    // return $pdf->download('disney.pdf');

    // $data =  Application::where('type','ration-aadhaar-form')->where('deleted_at',null)->get()->toArray();
    // return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
    //  $excel->sheet('mySheet', function($sheet) use ($data)
    //  {
    //      $sheet->fromArray($data);
    //  });
    // })->download("pdf");

}
public function pdfview(Request $request)
{


}

}
