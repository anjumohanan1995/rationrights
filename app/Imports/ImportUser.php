<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use Auth;
use Redirect;



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
        foreach($collection as $collect){

        /* $validate = Validator::make($collect->all(),
            [
              'name.*' => 'required',
              'lname' => 'required',
              'rank' => 'required',
              'gender' => 'required',
              'dob' => 'required',
              'address' => 'required',
              'pin_code' => 'required',
              'mobile' => 'required',
              'district' => 'required',
              'location' => 'required',
              'emp_id' => 'required',
               'email'=>['required','email',Rule::unique('users','email')->whereNull('deleted_at')],
           
              'pen_no' => 'required|min:6|unique:users',
              'password' => 'required' ,
              'role' => 'required' ,

           
        ]);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate);
        }*/
        //dd($collect[1]);
        $userExist = User::where('email',$collect[10])->where('deleted_at',null)->get();
        $userExistpen = User::where('pen_no',$collect[1])->where('deleted_at',null)->get();
       // dd(count($userExist));
        if(count($userExist) >= 1 ){
             return Redirect::back()->with('danger','User Email already exist');

        }
        if(count($userExistpen) >= 1 ){
             return Redirect::back()->with('danger','User Pen No already exist');

        }

        else{

            

            
            $data = new User();
          
            $data->name=$collect[0];
            $data->pen_no=$collect[1];
            $data->rank=$collect[2];
            $data->gender=$collect[3];
            $data->dob=$collect[4];
            $data->address=$collect[5];
           
            $data->pin_code=$collect[6];
            $data->phone_no=$collect[7];
            $data->mobile=$collect[8];
            $data->password=Hash::make($collect[9]);
            $data->email=$collect[10];
            $data->emp_id=$collect[1];
            $data->role=$collect[11];
            $data->user_id=Auth::user()->id;
            $data->save();
             
        }

        }
    }
}
