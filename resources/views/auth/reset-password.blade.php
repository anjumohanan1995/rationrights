@extends('layouts.app_login')

@section('content')
<div class="container">
    <div class="row justify-content-center d-flex m-5">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}

                <div class="card-body">

                    <form method="POST" action="{{ url('set-new-password') }}">
                        @csrf


                        {{-- <input type="hidden" name="user_id" value="{{encrypt($user_id)}}">

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="confirm_password" required autocomplete="off" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"> SUBMIT HERE

                                </button>
                            </div>
                        </div>  --}}

                        {{-- <a href="" type="submit" class="btn btn-success">submit</a> --}}

          <div >
            @foreach ($errors->all() as $error)
            <li style="list-style-type: none;" class="alert alert-danger">{{ $error }}</li>
        @endforeach
          </div>

                        <input type="hidden" name="user_id" value="{{encrypt($user_id)}}">

                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right">Password</label>

                          <div class="col-md-6">
                            <input type="text" class="form-control" name="password" required  autocomplete="new-password">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                          <div class="col-md-6">
                            <input type="password" class="form-control" name="confirm_password" required  >
                          </div>
                        </div>

                        {{-- <input class="masked" type="password" autocomplete="new-password" name="password">
                        <input class="masked" type="text" autocomplete="off" name="confirm-password"> --}}

                        <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                          </div>
                        </div>


                    </form>

                    <style>
                        .masked {
                          -webkit-text-security: disc;
                          -moz-text-security: disc;
                          -ms-text-security: disc;
                          text-security: disc;
                        }
                        </style>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
