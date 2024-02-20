<!DOCTYPE html>
<html>

<head>
    @php
        $host = request()->getHost();

    @endphp
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="Description" content="RateUP" />
    <meta name="Author" content="" />
    <!-- Title -->
    <title>Rateup</title>


    <!--- Favicon --->
    <link rel="icon" href="{{ asset('img/gov2.jpeg') }}" type="image/x-icon" />
    <!-- Bootstrap css -->


    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" id="style" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

    <!--- Style css --->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" />
    <!--- Icons css --->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" />
    <!--- Animations css --->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
    <!-- Switcher css -->
    <link href="{{ asset('css/switcher.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    @yield('css')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <?php
    if (session()->has('style_status')) {
        $style_status = session()->get('style_status');
        $locale = session()->get('locale');
    } else {
        $style_status = 'aone';
    }
    ?>

    @if (!empty($style_status))
        @if ($style_status == 'aminus')
            <link href="{{ asset('css/style_minus.css') }}" rel="stylesheet" />
        @endif
        @if ($style_status == 'aone')
        @endif



        @if ($style_status == 'aplus')
            <link href="{{ asset('css/style_plus.css') }}" rel="stylesheet" />
        @endif
    @endif



    <meta http-equiv="imagetoolbar" content="no" />





</head>

<body class="main-body app sidebar-mini ltr">
    <div class="horizontalMenucontainer">
        <!-- Switcher -->

        <!-- End Switcher -->
        <!-- Loader -->
        <div id="global-loader">
            <img src="{{ asset('img/loader.gif') }}" class="loader-img" alt="Loader" width="250" />
        </div>
        <!-- /Loader -->
        <!-- page -->
        <div class="page custom-index">

            <!-- main-header -->
            <div class="main-header side-header sticky nav nav-item" style="margin-bottom: -63px;">
                <div class="container-fluid main-container">
                    <div class="main-header-left">
                        <div class="app-sidebar__toggle mobile-toggle" data-bs-toggle="sidebar">
                            <a class="open-toggle" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" class="eva eva-menu-outline header-icons">
                                    <g data-name="Layer 2">
                                        <g data-name="menu">
                                            <rect width="24" height="24" transform="rotate(180 12 12)"
                                                opacity="0"></rect>
                                            <rect x="3" y="11" width="18" height="2"
                                                rx=".95" ry=".95"></rect>
                                            <rect x="3" y="16" width="18" height="2"
                                                rx=".95" ry=".95"></rect>
                                            <rect x="3" y="6" width="18" height="2"
                                                rx=".95" ry=".95"></rect>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <a class="close-toggle" href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" class="eva eva-close-outline header-icons">
                                    <g data-name="Layer 2">
                                        <g data-name="close">
                                            <rect width="24" height="24" transform="rotate(180 12 12)"
                                                opacity="0"></rect>
                                            <path
                                                d="M13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29-4.3 4.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l4.29-4.3 4.29 4.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                        <div class="responsive-logo">
                            <a href="/" class="header-logo">
                                <img src="{{ asset('img/gov2.jpeg') }}" class="logo-11" />
                            </a>
                            <a href="/" class="header-logo">
                                <img src="{{ asset('img/logo-white.png') }}" class="logo-1" />
                            </a>
                        </div>
                        <ul class="header-megamenu-dropdown nav">

                            <li class="nav-item">
                                <div class="dropdown-menu-rounded btn-group ">
                                    <button aria-expanded="false" aria-haspopup="true" class="btn btn-link"
                                        data-bs-toggle="dropdown" id="" type="button">
                                        <!-- 	<span>   English </span> -->
                                    </button>

                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown-menu-rounded btn-group ">
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn btn-link @if ($style_status == 'aminus') border border-radius @endif  aminus"
                                        data-bs-toggle="dropdown" id="" type="button">
                                        <span> A- </span>
                                    </button>
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn btn-link @if ($style_status == 'aone') border border-radius @endif  aone"
                                        data-bs-toggle="dropdown" id="" type="button">
                                        <span> A </span>
                                    </button>
                                    <button aria-expanded="false" aria-haspopup="true"
                                        class="btn btn-link @if ($style_status == 'aplus') border border-radius @endif  aplus"
                                        data-bs-toggle="dropdown" id="" type="button">
                                        <span> A+ </span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                        aria-controls="navbarSupportedContent-4" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fe fe-more-vertical header-icons navbar-toggler-icon"> </i>
                    </button>
                    <div
                        class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0 mg-lg-s-auto">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <div class="main-header-right">
                                <!-- <div class="nav nav-item nav-link" id="bs-example-navbar-collapse-1"> -->
                                <!-- <form class="navbar-form" role="search">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" />
            <span class="input-group-btn">
             <button type="reset" class="btn btn-default">
              <i class="fas fa-times"> </i>
             </button>
             <button type="submit" class="btn btn-default nav-link">
              <i class="fe fe-search"> </i>
             </button>
            </span>
           </div>
          </form> -->
                                <!-- </div> -->
                                <!--<li class="dropdown nav-item main-layout">
          <a class="new theme-layout nav-link-bg layout-setting">
           <span class="dark-layout">
            <i class="fe fe-moon"> </i>
           </span>
           <span class="light-layout">
            <i class="fe fe-sun"> </i>
           </span>
          </a>
         </li>-->
                                <div class="nav nav-item navbar-nav-right mg-lg-s-auto">
                                    <!-- <div class="nav-item full-screen fullscreen-button">
           <a class="new nav-link full-screen-link" href="javascript:void(0);">
            <i class="fe fe-maximize"> </i>
           </a>
          </div> -->
                                    <!-- <div class="dropdown nav-item main-header-message">
           <a class="new nav-link" href="javascript:void(0);">
            <i class="fe fe-mail"> </i>
            <span class="pulse-danger"> </span>
           </a>
           <div class="dropdown-menu">
            <div class="menu-header-content bg-primary-gradient text-start d-flex">
             <div class="">
              <h6 class="menu-header-title text-white mb-0">5 new Messages</h6>
             </div>
             <div class="my-auto mg-s-auto">
              <a class="badge bg-pill bg-warning float-end" href="javascript:void(0);">Mark All Read</a>
             </div>
            </div>
            <div class="main-message-list chat-scroll ps">
             <a href="mail.html" class="p-3 d-flex border-bottom">
              <div class="drop-img cover-image" data-bs-image-src="img/faces/3.jpg" style='background: url("img/faces/3.jpg") center center;'>
               <span class="avatar-status bg-teal"> </span>
              </div>
              <div class="wd-90p">
               <div class="d-flex">
                <h5 class="mb-1 name">Paul Molive</h5>
                <p class="time mb-0 text-end ms-auto float-end">10 min ago</p>
               </div>
               <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
              </div>
             </a>
             <a href="mail.html" class="p-3 d-flex border-bottom">
              <div class="drop-img cover-image" data-bs-image-src="img/faces/2.jpg" style='background: url("img/faces/2.jpg") center center;'>
               <span class="avatar-status bg-teal"> </span>
              </div>
              <div class="wd-90p">
               <div class="d-flex">
                <h5 class="mb-1 name">Sahar Dary</h5>
                <p class="time mb-0 text-end ms-auto float-end">13 min ago</p>
               </div>
               <p class="mb-0 desc">All set ! Now, time to get to you now......</p>
              </div>
             </a>
             <a href="mail.html" class="p-3 d-flex border-bottom">
              <div class="drop-img cover-image" data-bs-image-src="img/9.jpg" style='background: url("img/9.jpg") center center;'>
               <span class="avatar-status bg-teal"> </span>
              </div>
              <div class="wd-90p">
               <div class="d-flex">
                <h5 class="mb-1 name">Khadija Mehr</h5>
                <p class="time mb-0 text-end ms-auto float-end">20 min ago</p>
               </div>
               <p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
              </div>
             </a>
             <a href="mail.html" class="p-3 d-flex border-bottom">
              <div class="drop-img cover-image" data-bs-image-src="img/12.jpg" style='background: url("img/12.jpg") center center;'>
               <span class="avatar-status bg-danger"> </span>
              </div>
              <div class="wd-90p">
               <div class="d-flex">
                <h5 class="mb-1 name">Barney Cull</h5>
                <p class="time mb-0 text-end ms-auto float-end">30 min ago</p>
               </div>
               <p class="mb-0 desc">Here are some products ...</p>
              </div>
             </a>
             <a href="mail.html" class="p-3 d-flex border-bottom">
              <div class="drop-img cover-image" data-bs-image-src="img/5.jpg" style='background: url("img/5.jpg") center center;'>
               <span class="avatar-status bg-teal"> </span>
              </div>
              <div class="wd-90p">
               <div class="d-flex">
                <h5 class="mb-1 name">Petey Cruiser</h5>
                <p class="time mb-0 text-end ms-auto float-end">35 min ago</p>
               </div>
               <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
              </div>
             </a>
             <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
             </div>
             <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
             </div>
            </div>
            <div class="text-center dropdown-footer">
             <a href="mail.html">VIEW ALL</a>
            </div>
           </div>
          </div>  -->
                                    @php
                                        $date = date('Y-m-d');
                                        $getNotifications = DB::table('notifications')
                                            ->where('date', $date)
                                            ->where('status', 0)
                                            ->orderBy('created_at', 'desc')
                                            ->get();
                                    @endphp
                                    <div class="dropdown nav-item main-header-notification">
                                        <a class="new nav-link" href="javascript:void(0);">
                                            <i class="fe fe-bell"> </i>

                                            <span class="pulse"> {{ count(@$getNotifications) }}</span>

                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="menu-header-content bg-primary-gradient text-start d-flex">
                                                <div class="">
                                                    <h6 class="menu-header-title text-white mb-0">Notifications</h6>
                                                </div>
                                                <!-- <div class="my-auto ms-auto">
              <a class="badge bg-pill bg-warning float-end" href="javascript:void(0);">Mark All Read</a>
             </div> -->
                                            </div>
                                            <div class="main-notification-list Notification-scroll ">


                                                @foreach ($getNotifications as $notification)
                                                    <a class="d-block p-3 border-bottom float-start"
                                                        href="{{ url('notification-view', $notification['_id']) }}">
                                                        <div class="notifyimg bg-success-transparent float-start me-3">
                                                            <i class="la la-bell text-success"> </i>
                                                        </div>
                                                        <div class=" w-70 float-start">
                                                            <h5 class="notification-label mb-1">
                                                                {{ @$notification['message'] }}</h5>
                                                            <div class="notification-subtext">Date
                                                                {{ date('d-m-Y', strtotime(@$notification['date'])) }}
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto float-start">
                                                            <i class="las la-angle-right text-end text-muted"> </i>
                                                        </div>
                                                    </a>
                                                @endforeach

                                                <!-- 	<a class="d-flex p-3 border-bottom" href="javascript:void(0);">
              <div class="notifyimg bg-danger-transparent">
               <i class="la la-user-check text-danger"> </i>
              </div>
              <div class="ms-3">
               <h5 class="notification-label mb-1">22 verified registrations</h5>
               <div class="notification-subtext">2 hour ago</div>
              </div>
              <div class="ms-auto">
               <i class="las la-angle-right text-end text-muted"> </i>
              </div>
             </a>
             <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
              <div class="notifyimg bg-primary-transparent">
               <i class="la la-check-circle text-primary"> </i>
              </div>
              <div class="ms-3">
               <h5 class="notification-label mb-1">Project has been approved</h5>
               <div class="notification-subtext">4 hour ago</div>
              </div>
              <div class="ms-auto">
               <i class="las la-angle-right text-end text-muted"> </i>
              </div>
             </a>
             <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
              <div class="notifyimg bg-pink-transparent">
               <i class="la la-file-alt text-pink"> </i>
              </div>
              <div class="ms-3">
               <h5 class="notification-label mb-1">New files available</h5>
               <div class="notification-subtext">10 hour ago</div>
              </div>
              <div class="ms-auto">
               <i class="las la-angle-right text-end text-muted"> </i>
              </div>
             </a>
             <a class="d-flex p-3 border-bottom" href="javascript:void(0);">
              <div class="notifyimg bg-warning-transparent">
               <i class="la la-envelope-open text-warning"> </i>
              </div>
              <div class="ms-3">
               <h5 class="notification-label mb-1">New review received</h5>
               <div class="notification-subtext">1 day ago</div>
              </div>
              <div class="ms-auto">
               <i class="las la-angle-right text-end text-muted"> </i>
              </div>
             </a>
             <a class="d-flex p-3" href="javascript:void(0);">
              <div class="notifyimg bg-purple-transparent">
               <i class="la la-gem text-purple"> </i>
              </div>
              <div class="ms-3">
               <h5 class="notification-label mb-1">Updates Available</h5>
               <div class="notification-subtext">2 days ago</div>
              </div>
              <div class="ms-auto">
               <i class="las la-angle-right text-end text-muted"> </i>
              </div>
             </a> -->
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                    <div class="ps__thumb-x" tabindex="0"
                                                        style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                    <div class="ps__thumb-y" tabindex="0"
                                                        style="top: 0px; height: 0px;"></div>
                                                </div>
                                            </div>
                                            <!-- <div class="dropdown-footer">
             <a href="javascript:void(0);">VIEW ALL</a>
            </div> -->
                                        </div>
                                    </div>
                                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                                        <a class="profile-user d-flex" href="">
                                            @if (Auth::user()->image != '')
                                                <img src="{{ url('/') }}/admin/uploads/images/{{ Auth::user()->image }}"
                                                    alt="user-img" class="rounded-circle mCS_img_loaded" />
                                            @else
                                                <img src="{{ url('/') }}/img/user.png" alt="user-img"
                                                    class="rounded-circle mCS_img_loaded" />
                                            @endif
                                            <span> </span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="main-header-profile header-img">
                                                <div class="main-img-user">
                                                    @if (Auth::user()->image != '')
                                                        <img
                                                            src="{{ url('/') }}/admin/uploads/images/{{ Auth::user()->image }}" />
                                                    @else
                                                        <img src="{{ url('/') }}/img/user.png" />
                                                    @endif
                                                </div>
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <!-- <span>Premium Member</span> -->
                                            </div>
                                            <!-- 		<a class="dropdown-item" href="profile.html"> <i class="far fa-user"> </i> My Profile</a>
            <a class="dropdown-item" href="profile.html"> <i class="far fa-edit"> </i> Edit Profile</a>
            <a class="dropdown-item" href="profile.html"> <i class="far fa-clock"> </i> Activity Logs</a>
            <a class="dropdown-item" href="profile.html"> <i class="fas fa-sliders-h"> </i> Account Settings</a> -->
                                            <a class="dropdown-item" href="{{ route('profile.manage') }}"> <i
                                                    class="far fa-edit"> </i> View Profile</a>


                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                    class="fas fa-sign-out-alt"> </i>
                                                {{ __('Sign Out') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                            <!-- 	<a class="dropdown-item" href="signup.html"> <i class="fas fa-sign-out-alt"> </i> Sign Out</a> -->
                                        </div>
                                    </div>
                                    <!--<div class="dropdown main-header-message right-toggle">
           <a class="nav-link pe-0" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
            <i class="ion ion-md-menu tx-20 bg-transparent"> </i>
           </a>
          </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="d-flex header-setting-icon">
       <a class="nav-link icon demo-icon" href="javascript:void(0);">
        <i class="fe fe-settings fe-spin"> </i>
       </a>
      </div> -->
                </div>
            </div>

            <!-- /main-header -->
            <!-- main-sidebar -->
            <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
            <div class="sticky is-expanded" style="margin-bottom: -63px;">
                <aside class="app-sidebar ps ps--active-y open">
                    <div class="main-sidebar-header active">
                        <a class="desktop-logo logo-light active" href="{{ url('homes') }}">
                            <img src="{{ asset('img//gov.jpeg') }}" width="200px" class="main-logo" alt="logo" />
                        </a>
                        <a class="desktop-logo logo-dark active" href="/">
                            <img src="{{ asset('img//logo-white.png') }}" class="main-logo" alt="logo" />
                        </a>
                        <a class="logo-icon mobile-logo icon-light active" href="/">
                            <img src="{{ asset('img//small-logo.png') }}" alt="logo" />
                        </a>
                        <a class="logo-icon mobile-logo icon-dark active" href="/">
                            <img src="{{ asset('img//logo.png') }}" alt="logo" />
                        </a>
                    </div>
                    <div class="main-sidemenu is-expanded">
                        <div class="main-sidebar-loggedin">
                            <!--<div class="user-info">
           <h6 class="mb-0 text-dark">&nbsp;</h6>

          </div>-->

                        </div>
                        <div class="sidebar-navs">
                            <ul class="nav nav-pills-circle">
                                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Settings" aria-describedby="tooltip365540">
                                    <a class="nav-link text-center m-2">
                                        <i class="fe fe-settings"> </i>
                                    </a>
                                </li>
                                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Chat" aria-describedby="tooltip143427">
                                    <a class="nav-link text-center m-2">
                                        <i class="fe fe-mail"> </i>
                                    </a>
                                </li>
                                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Followers">
                                    <a class="nav-link text-center m-2">
                                        <i class="fe fe-user"> </i>
                                    </a>
                                </li>
                                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Logout">
                                    <a class="nav-link text-center m-2">
                                        <i class="fe fe-power"> </i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="slide-left disabled active is-expanded d-none" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                            </svg>
                        </div>
                         @php
                                @$role =\Auth::user()->role;
                                $permission = \App\RolePermission::where('role', \Auth::user()->role)->first();

                                @$sub_permission = $permission->sub_permissions ? json_decode($permission->sub_permissions, true) : null;

                            @endphp
                            @if(Auth::user()->role=="Student")
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="">
                                    <i class="side-menu__icon fe fe-download"> </i>
                                    <span class="side-menu__label">Download</span>
                                    <i class="angle fe fe-chevron-down"> </i>
                                </a>

                                <ul class="slide-menu">

                                        <li class="sub-slide">
                                            <a class="slide-item" data-bs-toggle="sub-slide"
                                                href="">
                                                <span class="sub-side-menu__label">Reciept Download</span>
                                            </a>
                                        </li>

                                </ul>

                            </li>
                            @endif



                        <ul class="side-menu open" style="margin-right: 0px;">
                            <li class="slide is-expanded">
                                <a class="side-menu__item active" href="{{ url('homes') }}">
                                    <i class="side-menu__icon fe fe-airplay"> </i>
                                    <span class="side-menu__label">Dashboard</span>
                                </a>
                            </li>
                            @php
                            $permission = \App\RolePermission::where('role', \Auth::user()->role)->first();
                            //  dd(Auth::user()->name);
                            //dd($permission);
                             @$sub_permission= ($permission->sub_permissions)? json_decode($permission->sub_permissions,true) :  null;
                           //dd($sub_permission);
                        @endphp
                         @if (!empty($permission))

                            @foreach (@$permission->permission as $permissions)
                            @if (@$permissions == 'user-management')
                                        <li class="slide {{ request()->is('user-management') || request()->is('roles') || request()->is('permissions') ? 'is-expanded' : ''  }}" >
                                            <a class="side-menu__item" data-bs-toggle="slide" href="">
                                                <i class="side-menu__icon fe fe-user"> </i>
                                                <span class="side-menu__label">User Management</span>
                                                <i class="angle fe fe-chevron-down"> </i>
                                            </a>

                                            <ul class="slide-menu">
                                                @if ($sub_permission && is_array($sub_permission) && in_array('users', $sub_permission))
                                                <li class="sub-slide">
                                                        <a class="slide-item {{ request()->is('user-management') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('user-management') }}">
                                                            <span class="sub-side-menu__label">Users</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if ($sub_permission && is_array($sub_permission) && in_array('add-role', $sub_permission))

                                                <li class="sub-slide ">
                                                        <a class="slide-item {{ request()->is('roles') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('roles') }}">
                                                            <span class="sub-side-menu__label">Roles</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if ($sub_permission && is_array($sub_permission) && in_array('permission', $sub_permission))

                                                 <li class="sub-slide">
                                                        <a class="slide-item {{ request()->is('permissions') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('permissions') }}">
                                                            <span class="sub-side-menu__label">Permission</span>
                                                        </a>
                                                    </li>
                                                    @endif

                                            </ul>


                                        </li>

                                        {{-- applications form starts here  --}}
                                        <li class="slide {{ request()->is('applications-form/form') ? 'is-expanded' : ''  }}" >
                                            <a class="side-menu__item" data-bs-toggle="slide" href="">
                                                <i class="side-menu__icon fe fe-user"> </i>
                                                <span class="side-menu__label">Applications Form</span>
                                                <i class="angle fe fe-chevron-down"> </i>
                                            </a>

                                            <ul class="slide-menu">
                                                <li class="sub-slide">
                                                        <a class="slide-item {{ request()->is('applications-form/form') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('applications-form/form') }}">
                                                            <span class="sub-side-menu__label">Form</span>
                                                        </a>
                                                    </li>

                                            </ul>
                                        </li>

                                        {{-- applications form ends here  --}}

                                        {{-- </li> --}}
                                        @endif

                                        @if (@$permissions == 'Applications')
                                        <li class="slide {{ request()->is('application-list') || request()->is('adhaar-application-list') || request()->is('no-adhaar-ration-application-list') ? 'is-expanded' : ''  }}" >
                                            <a class="side-menu__item" data-bs-toggle="slide" href="">
                                                <i class="side-menu__icon fe fe-user"> </i>
                                                <span class="side-menu__label">Applications List</span>
                                                <i class="angle fe fe-chevron-down"> </i>
                                            </a>

                                            <ul class="slide-menu">
                                                @if ($sub_permission && is_array($sub_permission) && in_array('Adhar and ration card', $sub_permission))

                                                <li class="sub-slide">
                                                        <a class="slide-item {{ request()->is('application-list') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('application-list') }}">
                                                            <span class="sub-side-menu__label">Ration Card & Aadhaar</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if ($sub_permission && is_array($sub_permission) && in_array('Adhar only', $sub_permission))

                                                <li class="sub-slide ">
                                                        <a class="slide-item {{ request()->is('adhaar-application-list') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('adhaar-application-list') }}">
                                                            <span class="sub-side-menu__label">Aadhaar Only</span>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if ($sub_permission && is_array($sub_permission) && in_array('No adhar and ration card', $sub_permission))

                                                 <li class="sub-slide">
                                                        <a class="slide-item {{ request()->is('no-adhaar-ration-application-list') ? 'active' : '' }}" data-bs-toggle="sub-slide"
                                                            href="{{ url('no-adhaar-ration-application-list') }}">
                                                            <span class="sub-side-menu__label">No Ration Card & Aadhaar</span>
                                                        </a>
                                                    </li>
                                                    @endif

                                            </ul>

                                        </li>
                                        @endif
                                        @endforeach
                                        @endif












                            <li class="slide">

                                  <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                             <i class="side-menu__icon fas fa-sign-out-alt"> </i>
                                        <span class="side-menu__label">Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                            </li>
                            <!-- <li class="slide">
         <a class="side-menu__item"  href="{{ url('group-management') }}">
          <i class="side-menu__icon fe fe-package"> </i>
          <span class="side-menu__label">Group Management</span>
          <i class="angle fe fe-chevron-right"> </i>
         </a>
        </li> -->
                        </ul>
                        <div class="slide-right" id="slide-right">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 652px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 515px;"></div>
                    </div>
                </aside>
            </div>

            <!-- main-sidebar -->
            @yield('content')
            <!-- /main-content -->
            <!--Sidebar-right-->


            <!--/Sidebar-right-->
            <!-- Footer opened -->
            <div class="main-footer ht-45">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>
                        Copyright © 2023 <a href="javascript:void(0);" class="text-primary">RateUP</a>. Designed with
                        <span class="fa fa-heart text-danger"> </span> by <a href="javascript:void(0);"> Kawika
                            Technologies </a> All rights reserved.
                    </span>
                </div>
            </div>

            <!-- Footer closed -->
        </div>
        <!-- page closed -->
        <!--- Back-to-top --->
        <a href="#top" id="back-to-top" style="display: block;">
            <i class="las la-angle-double-up"> </i>
        </a>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/datepicker.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/ionicons.js') }}"></script>
        <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('js/chart.flot.sampledata.js') }}"></script>
        <script src="{{ asset('js/eva-icons.min.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('js/p-scroll.js') }}"></script>
        <script src="{{ asset('js/sidemenu.js') }}"></script>
        <script src="{{ asset('js/sticky.js') }}"></script>
        <script src="{{ asset('js/sidebar.js') }}"></script>
        <script src="{{ asset('js/sidebar-custom.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="{{ asset('js/themecolor.js') }}"></script>
        <script src="{{ asset('js/swither-styles.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/switcher.js') }}"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



        <!-- 	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

        <!-- <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> -->
        <script></script>

        <!-- [...] -->





        <script>
            $(function() {
                $("#datepicker").datepicker();
                $("#to_datepicker").datepicker();

            });
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example1').DataTable();
                $('#example2').DataTable();
                $('#example3').DataTable();


            });
        </script>
        <script type="text/javascript">
            $('.aminus').on('click', function() {
                //alert("aminus");
                let url = "{{ route('changeStatus') }}";
                window.location.href = url + "?status=aminus";
            });
            $('.aone').on('click', function() {
                //alert("aone");
                let url = "{{ route('changeStatus') }}";
                window.location.href = url + "?status=aone";
            });
            $('.aplus').on('click', function() {
                //alert("aplus");
                let url = "{{ route('changeStatus') }}";
                window.location.href = url + "?status=aplus";
            });
        </script>
    </div>
    <div class="main-navbar-backdrop"></div>
</body>

</html>
