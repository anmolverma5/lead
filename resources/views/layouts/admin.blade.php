<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/admin/assets/images/favicon(32x32).png') }}">

    <title>Lead Management</title>
    <!-- Jquery Min js -->
     <script src="{{ asset('public/admin/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('public/admin/assets/plugins/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/admin/main/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('public/admin/main/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- toastr CSS  & JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style type="text/css">
    .addButton{
        float: right !important; 
        color: #fff !important;
    }
    img.dark-logo {
    margin-top: 5px;
}
</style>

<!-- This is data table -->
    <script src="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <link href="{{ asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- logo.jpg -->
                           <!-- <img src="{{ asset('public/admin/assets/images/logo5.png') }}" alt="homepage" class="dark-logo" />
    
                            <img src="{{ asset('public/admin/assets/images/logo5.png') }}" alt="homepage" class="light-logo" /> -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <b>
                         <!-- dark Logo text -->
                         <img src="{{ asset('public/admin/assets/images/relocity_logo.png') }}" alt="homepage" class="dark-logo" />
                  
                         <img src="{{ asset('public/admin/assets/images/relocity_logo.png') }}" class="light-logo" alt="homepage" /></b> </span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <!--<a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>-->
                            <div class="dropdown-menu mailbox animated slideInUp">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just View the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just View the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <!--<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>--->
                            <div class="dropdown-menu mailbox animated slideInUp" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">You have 4 new messages</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="{{ asset('public/admin/assets/images/users/1.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just View the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="{{ asset('public/admin/assets/images/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! View you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="{{ asset('public/admin/assets/images/users/3.jpg') }}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="user-img"> <img src="{{ asset('public/admin/assets/images/users/4.jpg') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just View the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>View all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> 
                            <!--<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>-->
                            <div class="dropdown-menu animated slideInUp">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-3 col-xlg-2 m-b-30">
                                        <h4 class="m-b-20">CAROUSEL</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container"> <img class="d-block img-fluid" src="{{ asset('public/admin/assets/images/big/img1.jpg') }}" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="{{ asset('public/admin/assets/images/big/img2.jpg') }}" alt="Second slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="{{ asset('public/admin/assets/images/big/img3.jpg') }}" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </li>
                                    <li class="col-lg-3 m-b-30">
                                        <h4 class="m-b-20">ACCORDION</h4>
                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Collapsible Group Item #1
                                                </a>
                                              </h5> </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high. </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Collapsible Group Item #2
                                                </a>
                                              </h5> </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingThree">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  Collapsible Group Item #3
                                                </a>
                                              </h5> </div>
                                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3  m-b-30">
                                        <h4 class="m-b-20">CONTACT US</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>-->
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li>-->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="@if(!empty(auth()->user()->image))
                                    {{ url('storage/app/images/'.auth()->user()->image) }}
                                @else
                                  {{ url('storage/app/images/default_green.png') }}
                                @endif" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="@if(!empty(auth()->user()->image))
                                    {{ url('storage/app/images/'.auth()->user()->image) }}
                                @else
                                  {{ url('storage/app/images/default_green.png') }}
                                @endif" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ auth()->user()->name }}</h4>
                                                <p class="text-muted">{{ auth()->user()->email }}</p>
                                                <!--<a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>--></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('profile') }}"  class="dropdown-item">Edit Profile</a></li>
                                    <!--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>-->
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="@if(!empty(auth()->user()->image))
                                    {{ url('storage/app/images/'.auth()->user()->image) }}
                                @else
                                  {{ url('storage/app/images/default_green.png') }}
                                @endif" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>{{ auth()->user()->name }} </h5>
                        <!--<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>-->
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <!-- text-->
                            <div class="dropdown-divider"></div>
                            <!-- text-->
                            <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">

                    @if(auth()->user()->is_admin == 1)

                        <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Employee Panel</li>
                          <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Home </span></a>  <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('/campaign/camp_assign_emp') }}" aria-expanded="false"><i class=" fa fa-file"></i><span class="hide-menu">Campaign</span>  </a> 
        
                        </li>
                         <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('notes') }}" aria-expanded="false"><i class=" fa fa-file"></i><span class="hide-menu">Pending Leads</span>  </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <!--<li> <a  href="{{ url('installments') }}" aria-expanded="false"><i class="fa fa-money"></i>Installments</a> 
                        </li>-->



                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('leads/closed') }}">Closed Leads</a></li>
                                <li><a href="{{ url('leads/failed') }}">Failed Leads</a></li>
                            </ul>
                        </li>

                    </ul>


                    @elseif(auth()->user()->is_admin == 2)

                     <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Manager Panel</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('home') }}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Home </span></a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                         <li> <a  class="has-arrow waves-effect waves-dark" href="{{ url('analysis') }}" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">Analysis</span> </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>
                        
                        
                         <li> <a  class="has-arrow waves-effect waves-dark" href="{{ url('employees_performance?employee_id=&date_from=&date_to=') }}" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">Performance</span> </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <!--<li> <a  href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i> Performance </a> <span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>
                        </li>-->


                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Employee</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('employees') }}">View Employee</a></li>
                                <li><a href="{{ url('employees/create') }}">Add Employee</a></li>
                                
                            </ul>
                        </li>

                        <!--<li> <a  href="{{ url('installment') }}" aria-expanded="false"><i class="fa fa-money"></i>View Installments </a> 
                        </li>-->

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Add/View Campaign</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('sources') }}">View Campaign</a></li>
                                <li><a href="{{ url('sources/create') }}">Add Campaign</a></li>
                                
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Add/View Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('leads/create') }}">Add Leads</a></li>
                                <!-- <li><a href="{{ url('import') }}">Upload Bulk Leads</a></li> -->
                                <li><a href="{{ url('leads') }}">View Leads</a></li>
                                <!-- <li><a href="{{ url('leads/assign') }}">Assign Leads</a></li> -->
                                <li><a href="{{ url('leads/assign_lead_emp') }}">Assign Leads</a></li>
                                <li><a href="{{ url('leads/view') }}">View Employees Leads</a></li>
                                <li><a href="{{ url('feedbacks') }}">View Notes</a></li>
                                
                            </ul>
                        </li>

                    </ul>


                    @else

                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">Admin Panel</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="{{ url('home') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Home </span></a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                         <li> <a  class="has-arrow waves-effect waves-dark" href="{{ url('analysis') }}" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">Analysis</span> </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        
                         <li> <a  class="has-arrow waves-effect waves-dark" href="{{ url('employees_performance?employee_id=&date_from=&date_to=') }}" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">Performance</span> </a> <!--<span class="hide-menu">Dashboard <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="index.html">Minimal </a></li>
                                <li><a href="index2.html">Analytical</a></li>
                                <li><a href="index3.html">Demographical</a></li>
                                <li><a href="index4.html">Modern</a></li>
                            </ul>-->
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Manager</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('managers') }}">View Manager</a></li>
                                <li><a href="{{ url('managers/create') }}">Add Manager</a></li>
                                
                            </ul>
                        </li>

                       <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Add/View Employee</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('employees') }}">View Employee</a></li>
                                <li><a href="{{ url('employees/create') }}">Add Employee</a></li>
                                
                            </ul>
                        </li>

                       <!-- <li> <a  href="{{ url('installment') }}" aria-expanded="false"><i class="fa fa-money"></i>View Installments </a>-->

                
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Add/View Campaign</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('sources') }}">View Campaign</a></li>
                                <li><a href="{{ url('sources/create') }}">Add Campaign</a></li>
                                
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-check-square-o"></i><span class="hide-menu">Add/View Leads</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('leads/create') }}">Add Leads</a></li>
                                <!-- <li><a href="{{ url('import') }}">Upload Bulk Leads</a></li> -->
                                <li><a href="{{ url('leads') }}">View Leads</a></li>
                                <li><a href="{{ url('leads/assign') }}">Assign Leads</a></li>
                                <li><a href="{{ url('leads/view') }}">View Employees Leads</a></li>
                                <li><a href="{{ url('feedbacks') }}">View Notes</a></li>
                                
                            </ul>
                        </li>

                    </ul>

                    @endif
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="background-image: url({{ url('storage/app/images/back4.jpg') }});">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
             @yield('content')
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                ?? 2020 Powered by Fortec Solutions
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
    <!-- Bootstrap tether Core JavaScript -->
    <!--<script src="{{ asset('public/admin/assets/plugins/bootstrap/js/popper.min.js') }}"></script>-->
    <script src="{{ asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('public/admin/main/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('public/admin/main/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('public/admin/main/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('public/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('public/admin/main/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="{{ asset('public/admin/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--morris JavaScript -->
    <script src="{{ asset('public/admin/assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/morrisjs/morris.min.js') }}"></script>
   <!-- <script type="text/javascript" src="{{ asset('public/admin/main/js/morris-data.js') }}"></script>-->
   
   
   <!-- <script src="{{ asset('public/admin/assets/plugins/Chart.js/chartjs.init.js') }}"></script>-->
    <script src="{{ asset('public/admin/assets/plugins/Chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <script type="text/javascript">
    
    $( document ).ready(function() {
        const queryString = window.location.search;
        //console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const employee_id = urlParams.get('employee_id');
        const date_from = urlParams.get('date_from')
        const date_to = urlParams.get('date_to')
        //console.log(employee_id);

        //var url = '{{ url("new") }}/'+employee_id;
       var url = '{{ url("new") }}?employee_id='+employee_id+'&date_from='+date_from+'&date_to='+date_to;
        console.log(url);
        
        

    $.get(url, function(data, status){
        console.log(data);
        console.log('data');
        
        $("#pending").text(data[0].value);
        $("#failed").text(data[1].value);
        $("#closed").text(data[2].value);
        
        var ctx3 = document.getElementById("chart3").getContext("2d");
        var data3 = data;
    
        var myPieChart = new Chart(ctx3).Pie(data3,{
            segmentShowStroke : true,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 0,
            animationSteps : 100,
    		tooltipCornerRadius: 0,
            animationEasing : "easeOutBounce",
            animateRotate : true,
            animateScale : false,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    });
});

    $.get("{{route('allCounts')}}", function(data, status){
        // alert("Data: " + data + "\nStatus: " + status);
        //console.log(data);

        Morris.Donut({
            element: 'morris-donut-left',
            data: data['users'],
            resize: true,
            colors:['#009efb', '#55ce63', '#2f3d4a']
        });


        Morris.Donut({
            element: 'morris-donut-right',
            data: data['leads'],
            resize: true,
            colors:['#2f3d4a','#009efb', '#55ce63', 'red']
        });
    });
        
    
    $.get("{{route('performanceMonthly')}}", function(data, status){

        // alert("Data: " + data + "\nStatus: " + status);
        console.log(data);

        Morris.Bar({
            element: 'morris-bar-chart',
            data: data,
            xkey: 'month',
            ykeys: ['pending', 'failed', 'closed'],
            labels: ['Pending', 'Failed', 'Closed'],
            barColors:['#009efb', '#e30022', '#55ce63'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });

    });
    


    $.get("{{route('performanceYearly')}}", function(data, status){

        console.log(data);
/*
         Morris.Area({
        element: 'extra-area-chart',
        data: [{
                    period: '2010',
                    iphone: 0,
                    ipad: 0,
                    itouch: 0
                }, {
                    period: '2011',
                    iphone: 50,
                    ipad: 15,
                    itouch: 5
                }, {
                    period: '2012',
                    iphone: 20,
                    ipad: 50,
                    itouch: 65
                }, {
                    period: '2013',
                    iphone: 60,
                    ipad: 12,
                    itouch: 7
                }, {
                    period: '2014',
                    iphone: 30,
                    ipad: 20,
                    itouch: 120
                }, {
                    period: '2015',
                    iphone: 25,
                    ipad: 80,
                    itouch: 40
                }, {
                    period: '2016',
                    iphone: 10,
                    ipad: 10,
                    itouch: 10
                }


                ],
                lineColors: ['#55ce63', '#2f3d4a', '#009efb'],
                xkey: 'period',
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['Site A', 'Site B', 'Site C'],
                pointSize: 0,
                lineWidth: 0,
                resize:true,
                fillOpacity: 0.8,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto'
        
    });
*/

       Morris.Area({
            element: 'extra-area-chart',
            data: data,
            lineColors: ['#009efb', '#e30022', '#55ce63'],
            xkey: 'period',
            ykeys: ['pending', 'failed', 'closed'],
            labels: ['Pending', 'Failed', 'Closed'],
            pointSize: 0,
            lineWidth: 0,
            resize:true,
            fillOpacity: 0.8,
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            hideHover: 'auto'
        
        });





    });




    </script>


    <!-- Chart JS -->
    <script src="{{ asset('public/admin/main/js/dashboard1.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('public/admin/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

    <!-- This is data table -->
    <script src="{{ asset('public/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>

    <!-- Plugin JavaScript -->

    <script src="{{ asset('public/admin/assets/plugins/moment/moment.js') }}"></script>

    <script src="{{ asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script>
    // MAterial Date picker    
    
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;

    $("#min-date").val(output);

    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
     $('#min-date').bootstrapMaterialDatePicker({ time: false });
    $('#date_from').bootstrapMaterialDatePicker({ maxDate: new Date(), time: false });
     $('#date_to').bootstrapMaterialDatePicker({ maxDate: new Date(), time: false });
    </script>

    <script>
        function goBack() {
          window.history.back();
        }

         function reloadPage() {
            location.reload();
        }

    </script>


</body>

</html>