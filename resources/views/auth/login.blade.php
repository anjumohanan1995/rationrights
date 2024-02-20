@extends('layouts.app_login')

@section('content')
    <div class="my-auto page page-h">
        <div class="main-signin-wrapper">
            <div class="main-card-signin d-md-flex wd-100p sign_in">
                 

                <div class="p-5  wd-100p">
                    <div class="main-signin-header">
						<img src="img//gov.jpeg" class="main-logo" alt="logo" width="800px" >
                        <h2 class="mt-4 mb-4">Login</h2>
                         
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('succes'))
                            <div class="alert alert-success" role="alert">
                                {{ session('succes') }}
                            </div>
                        @endif
                         @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email" required
                                    autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> <div class="main-signin-footer mt-3 mb-3 text-end">
                                    <a href="{{ url('forgot-password') }}">Forgot password?</a> 
                                </div>
							<div class="wrap-login100-form-btn">
<div class="login100-form-bgbtn"></div>
 <button type="submit" class="login100-form-btn mt-0">
                                {{ __('Login') }} 
                            </button>
</div>
                           

                        </form>
                    </div>

                   
                </div>

            </div>
        </div>
    </div>
    <style>.sign_in{
        -webkit-box-shadow: 6px 11px 41px 2px rgb(126, 126, 125);
    }
    </style>
@endsection
