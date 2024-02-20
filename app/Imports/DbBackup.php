<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Location;
use Auth;
use Carbon\Carbon;
use DB;



class DbBackup implements ToCollection, WithStartRow
{
   /**
    * @param Collection $collection
    */


     /**
         * @return int
         */
        public function startRow(): int
        {
            return 2;
        }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $collection)
    {
        /*dd($collection);
         return new Patient([
            'name'     => @$collection[0],
            'age'    => @$collection[1],
            'user_id' =>Auth::user()->id
           
            
        ]);*/
        foreach($collection as $row){

            $table = 'records_'.$row[1];
                    //$record=   Records::create([   
                    $record=DB::table($table)->insert([  
                        'regi_no' => @$row[0]? str_replace(" ","",$row[0]):'',
                        'date' => @$row[1]?$row[1]:'',
                        'time' => @$row[2]?$row[2]:'',
                        'location' => @$row[3]?$row[3]:'',
                        'vehicle_dir' => @$row[4]?$row[4]:'',
                        'make' => @$row[5]?$row[5]:'',
                        'colour' => @$row[6]?$row[6]:'',
                        'violation' => @$row[8]?$row[8]:'',
                        'photo' =>@$row[7]?$row[7]:'',
                         'city' =>@$row[9]?$row[9]:'',
                         'lane_name' =>@$row[10]?$row[10]:'',
                         'camera_id' =>@$row[11]?$row[11]:'',
                         'created_at' =>Carbon::now(),
                        ]);







           /* $location = new Location();
          
            $location->location_name=$collect[0];
            $location->city=$collect[1];
            $location->district=$collect[2];
            $location->camera_vendor=$collect[3];
            $location->vendor_name=$collect[4];
            $location->contact_no=$collect[5];
            $location->email=$collect[6];
            $location->latitude=$collect[7];
            $location->longitude=$collect[8];
            $location->camera_id=$collect[9];
            
            $location->user_id=Auth::user()->id;
            
            $location->save();*/
        }
    }
}
