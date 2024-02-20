<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Middleware\ValidateReferer;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
      public function login(Request $request) {

        // dd('ehlo');
          //   dd($request);
        if(Auth::attempt($request->only(['email', 'password'])))
        {

            if(Auth::user()->deleted_at == ''){
               // dd(Auth::user());
               return redirect('/homes');
            }else{
                return redirect()
                    ->back()
                    ->with('error', 'Invalid Credentials');
            }


        }else{

            return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');

        }
      }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function middleware(Request $request, $user)
    // {
    //     return [
    //         ValidateReferer::class,
    //     ];
    // }

    public function authenticated(Request $request, $user) {

      Auth::logoutOtherDevices($request->get('password'));

    }

   /* public function middleware()
    {
        return [
            ValidateReferer::class,
        ];
    }*/
}
