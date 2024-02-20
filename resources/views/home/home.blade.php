@extends('home.app')
@section('content')


        <!-- Offcanvas Start -->
        <div class="offcanvas offcanvas-start" id="offcanvasMenu">

            <div class="offcanvas-header">
                <!-- Offcanvas Logo Start -->
                <div class="offcanvas-logo">
                    <a href="/">RateUP</a>
                </div>
                <!-- Offcanvas Logo End -->

                <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i
                        class="flaticon-close"></i></button>

            </div>
            <div class="offcanvas-body">
                <div class="offcanvas-menu">

                </div>
            </div>
        </div>
        <!-- Offcanvas End -->


        <!-- Hero Start -->
        <div class="eduhut-hero-section-04 d-flex align-items-center section">
            <img src="{{ asset('home/img/1.jpg') }}" height="800px" width="2800px !important" alt=""/>
            <div class="container">
                <!-- Hero Content Start -->
                <div class="hero-content text-center">
                    <h2 class="title" data-aos="fade-up" data-aos-delay="700">
                        Please fill the survey..</h2>

                    <div class="hero-form" data-aos="fade-up" data-aos-delay="900">
                        <form action="{{url('survey-home')}}" class="apply">
                            @csrf
                         <a href="{{url('survey-home')}}" > Start Survey </a>
                            <button class="search" type="submit"><i class="flaticon-right-arrow"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Hero Content End -->

            </div>
          @endsection
