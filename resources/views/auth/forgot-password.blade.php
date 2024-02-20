@extends('layouts.app_login')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="my-auto page page-h">
    <div class="main-signin-wrapper">
        <div class="main-card-signin d-md-flex wd-100p sign_in">
<div class="container">
    <h1 class="text-center my-5">Forgot Password</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif



            <form action=" {{ url('/forgot-password') }} " method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                        name="email" required>
                </div>
                {{-- <div class="form-group">
                    <label for="email">Date of Birth:</label>
                    <input type="date" class="form-control" id="email" placeholder="Date of Birth"
                        name="dob" >
                </div> --}}
                <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                    <label for="password" >Captcha</label>
                    <div class="col-md-12">
                        <div class="captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-info" class="reload" id="reload"> ↻
                        </button>                        </div>
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                        @if ($errors->has('captcha'))
                            <span class="help-block">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Send Code</button>
                </div>
            </form>
            <br>

        </div>
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
@push('script')
<script >
$(document).ready(function(){
    $('#reload').click(function(){

       $.ajax({

            type:'GET',
            url:"{{ route('refresh_captcha') }}",

            success:function(data){
            $(".captcha span").html(data.captcha);
            }

        });
   });
});
</script>
@endpush
