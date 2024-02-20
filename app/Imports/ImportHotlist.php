<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Hotlist;
use Auth;



class ImportHotlist implements ToCollection, WithStartRow
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

            $hotlist = new Hotlist();
          
            $hotlist->lp_number=$collect[0];
            $hotlist->category=$collect[1];
            $hotlist->make=$collect[2];
            $hotlist->model=$collect[3];
            $hotlist->colour=$collect[4];
            $hotlist->email=$collect[5];
            $hotlist->phone=$collect[6];
            $hotlist->address=$collect[7];
            $hotlist->description=$collect[8];
            $hotlist->date=date("Y-m-d");
            $hotlist->time=date("h:i:s");
            $hotlist->user_id=Auth::user()->id;
            
            $hotlist->save();
        }
    }
}
