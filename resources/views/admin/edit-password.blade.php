@extends('layouts.app_login')

@section('content')
    <div class="my-auto page page-h">
        <div class="main-signin-wrapper">
            <div class="main-card-signin d-md-flex wd-100p sign_in">
                {{-- <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-black">
                    <div class="my-auto authentication-pages">
                        <div>
                            <img src="img//logo.png" class="main-logo" alt="logo" height="100px">
                            <center><h4 class="mb-2 mt-4">Welcome to ILDM,
                            </h4>
                            <h3 style="font-family: Cursive;">"Empowering the youth for nation building by creating a resource pool of experts."</h3>
                        </center>
                        </div>
                    </div>
                </div> --}}

                <div class="p-5 wd-md-100p">
                    <div class="main-signin-header">
                        <h2 class="mt-4">Reset password here!</h2>
                        {{-- <h4>Please sign in to continue</h4> --}}
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('profile.password.edit.post') }}">
                            @csrf
                            <div class="form-group">
                                <label>Current password</label>
                                <input id="current_password" type="text"
                                    class="form-control @error('current_password') is-invalid @enderror" name="current_password" required
                                    autocomplete="off">

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input id="email" type="text"
                                    class="form-control @error('new_password') is-invalid @enderror" name="new_password" required
                                    autocomplete="off">

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="conf_password" type="password"
                                    class="form-control @error('conf_password') is-invalid @enderror" name="conf_password" required
                                    autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                            {{-- <input type="submit" value="Submit" class="btn btn-primary"> --}}

                        </form>
                    </div>

                    {{-- <div class="main-signin-footer mt-3 mg-t-5">
                                    <p><a href="{{ url('forgot-password') }}">Forgot password?</a></p>
                                </div> --}}
                </div>

            </div>
        </div>
    </div>
    <style>.sign_in{
        -webkit-box-shadow: 6px 11px 41px 2px rgb(126, 126, 125);
    }
    </style>
@endsection
