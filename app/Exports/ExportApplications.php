<?php

namespace App\Exports;

use App\Application;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportApplications implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {

        return [

            "Application No.",

            "Name",

            "Aadhaar No.",

            "Mobile No.",

            "Gender",

            "Since when staying in Kerala",

            "Home State",

            "Home District",

            "Eligible for IMPDS or Not",

           ];

        }
        public function collection()
        {

            $totalRecord =  Application::select('application_no','name','aadhar','mobile','gender','years','state','home_district','eligibility')->where('deleted_at',null);

            $records = $totalRecord->get();
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
                $aadhar =  $record->aadhar;
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
                    "eligibility" => $eligibility
                );

            }
            return $records;
        }



}
