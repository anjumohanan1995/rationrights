<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Location;
use Auth;
use Redirect;



class ImportLocation implements ToCollection, WithStartRow
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
        foreach($collection as $collect){

            $locationExist = Location::where('district',$collect[2])->where('location_name',$collect[0])->where('camera_id',$collect[9])->where('deleted_at',null)->get();
           // dd($collect[9]);
        //dd(count($locationExist));
    
        if(count($locationExist) >= 1 ){
             return Redirect::back()->with('danger','Location already exist');

        }

            $location = new Location();
          
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
            
            $location->save();
        }
    }
}
