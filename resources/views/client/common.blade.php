<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Jan 2018 09:55:31 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('client/assets/images/favicon.png')}}">
    <title>DBS | DA Booking System Any Place Any Time</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('client/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <!-- chartist CSS -->
    <link href="{{asset('client/assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <link href="{{asset('client/assets/plugins/css-chart/css-chart.css')}}" rel="stylesheet">
    <!-- toast CSS --> --}}
    <link href="{{asset('client/assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('client/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{asset('client/css/colors/blue.css')}}" id="theme" rel="stylesheet">

    <script src="{{asset('client/assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>   
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css')}} -->
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
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{asset('client/assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{asset('client/assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <img src="{{asset('client/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="{{asset('client/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                       
                        
                    </ul>
                    
                    <ul class="navbar-nav my-lg-0">
                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('client/download.jpg')}}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box" style="text-align: center;">
                                            
                                            <div class="u-img" style="width: 100%;"><img src="{{asset('client/download.jpg')}}" style="width: 80px;" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{@session('username')}}</h4>
                                                <p>{{@session('email')}}</p></div>

                                        </div>
                                    
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{url("profile")}}"><i class="ti-user"></i> My Profile</a></li>
                                   
                                    <li role="separator" class="divider"></li>
                                    <li><a href="\logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                      
                    </ul>
                </div>
            </nav>
        </header>
        
        <aside class="left-sidebar">
            
            <div class="scroll-sidebar">
                
                <div class="user-profile">
          
                    <div class="profile-text"> 
                       <p id="user_lbl"><?php echo session('username');?> </p>
                        <span class="caret"></span>
                       
                    </div>
                </div>
       
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">SERVICES</li>
                       
                      
                        <li>
                            
                            <a href="{{url('client/booking')}}">
                            <i class="mdi mdi-gauge"></i>
                            <span class="hide-menu">
                            Book Resources
                            
                            </span>
                            </a>
                            
                        </li>
                        <li>
                            
                            <a href="{{url('client_display')}}">
                            <i class="mdi mdi-bullseye">
                            </i>
                            <span class="hide-menu">Display Bookings</span>
                            </a>
                           
                        </li>
                        <li>
                            
                            <a href="{{url('request')}}">
                            <i class="mdi mdi-email"></i>
                            <span class="hide-menu">Respond to Request</span>
                            </a>
                          
                        </li>
                        <li>
                            
                            <a href="\logout">
                            
                            <i class="mdi mdi-power">
                            </i><span class="hide-menu">Log Out</span>
                            </a>
                            
                        </li>
                       
                        
                    </ul>
                </nav>
                
            </div>
          
        </aside>
        