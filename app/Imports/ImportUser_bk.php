<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;



class ImportUser implements ToCollection, WithStartRow
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

         Validator::make($collection->toArray(), [
             'name' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required',
             'emp_id' => 'required',
             'role' => 'required',
         ])->validate();


        foreach($collection as $collect){


             User::create([
                'name' => $collect[0],
                'lname' => $collect[1],
                'pen_no' => $collect[2],
                'rank' => $collect[3],
                'gender' => $collect[4],
                'dob' => $collect[5],
                'address' => $collect[6],
                'district' => $collect[7],
                'location' => $collect[8],
                'camera_id' => $collect[9],
                'pin_code' =>$collect[10],
                'phone_no' => $collect[11],
                'mobile' => $collect[12],
                'password' => Hash::make($collect[13]),
                'email' => $collect[14],
                'emp_id' => $collect[15],
                'role' => $collect[16],
                'user_id' => Auth::user()->id,


            ]);

           /* $data = new User();
          
            $data->name=$collect[0];
            $data->lname=$collect[1];
            $data->pen_no=$collect[2];
            $data->rank=$collect[3];
            $data->gender=$collect[4];
            $data->dob=$collect[5];
            $data->address=$collect[6];
            $data->district=$collect[7];
            $data->location=$collect[8];
            $data->camera_id=$collect[9];
            $data->pin_code=$collect[10];
            $data->phone_no=$collect[11];
            $data->mobile=$collect[12];
            $data->password=Hash::make($collect[13]);
            $data->email=$collect[14];
            $data->emp_id=$collect[15];
            $data->role=$collect[16];
            $data->user_id=Auth::user()->id;
            $data->save();*/
        }
    }
}
