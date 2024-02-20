<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);



        if (!auth()->attempt($loginData)) {
            
           
            return response(['message' => 'Invalid Credentials','status'  => 'Failed','sta_code' => 401]);
        }

        $authUser = User::where('email', $request->email)->first();
        if(!$authUser)
        {
            return response(['message' => 'Invalid Credentials','status'  => 'Failed','sta_code' => 401]);
        }else{
           // $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
           $authUser->device_key=$request->device_token??rand(100000,999999);
         $authUser->update();
        }
               $data =array();
              $data['access_token']= @$accessToken;
              $data['user'] = auth()->user(); 
              $data['device_token'] =$request->device_token??rand(100000,999999);

            
        return response(['status'=>'success','sta_code'=>200,'data'=>$data]);

    }



   



}
