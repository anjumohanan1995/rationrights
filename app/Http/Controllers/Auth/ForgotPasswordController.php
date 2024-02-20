<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\PasswordResetMail;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function forgotPassword(){

        return view('auth.forgot-password');
    }

    public function forgotPasswordPost(request $request){

        $request->validate([
            'email' => 'required|email',
            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha' => 'Invalid captcha code.']);
        $user = User::where('email',$request->email)->first();
        if($user){
            if($user){
                $token = Str::random(100);


            $user->update([
                'password_reset_token' => $token
            ]);
           // dd($token);
            Mail::to(request('email'))->send(new PasswordResetMail($user,$token));

            return redirect()->back()->with('message','Please check your inbox to reset the password');
            }
            return redirect()->back()->with('error','Sorry, Failed to find this Email!');


        }

        return redirect()->back()->with('error','Sorry, Failed to find this Email!');




    }

    public function restPassword($token){

        $user = User::where('password_reset_token',$token)->first();

        if($user){

            $user_id = $user->id;


            return view('auth.reset-password',compact('user_id'));
        }

         return redirect(url('forgot-password'))->with('error','An error occurred!');
    }




// changeing the password whith new one
    public function setNewPassword(Request $request)
    {



        $user = User::where('_id',decrypt(request('user_id')))->first();


        if($user){

            $request->validate([
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',

            ]);

            $user->update([
                'password' => Hash::make(request('password')),
                'password_reset_token' => null
            ]);



            return redirect(url('login-pannel'))->with('success','password sucessfully updated.');

        }

        return redirect()->back()->with('error', 'User not found');
    }
    public function refreshCaptcha()
    {

        return response()->json(['captcha'=> captcha_img()]);
    }

}
