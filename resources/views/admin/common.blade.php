<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>DBS | DA Booking System - Book  Any Place Any Time</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->


    <link href="{{asset('admin/css/lib/calendar2/semantic.ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->

    <div id="main-wrapper">
        <!-- header header  -->

<script type="text/javascript">
      $(document).ready(function(){
          $('#succ').hide();
      });
    </script>

    @if(session('error1'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#succ').show();   
           $('#succ').fadeOut(8000); 
        });
    </script>
@endif

@if(session('error1'))
<center>
<div id="succ" style="position: fixed;top: 5px; left: 20%; right: 20%; z-index: 2;padding:10px 5px;background: #15C3B6"><div class="alert alert-success">
                <strong>Done!</strong> {{session('error1')}}
              </div>
            </div></center>
@endif
        
        <div class="header">
     
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('admin/dashboard')}}">
                        <!-- Logo icon -->
                        <b><img src="images/logo.png" alt="homepage" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span><img src="images/logo-text.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <!-- End Logo -->
                <div  class="navbar-collapse">
                    <ul style="margin-left:auto" class="navbar-nav my-lg-0">
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/users/download.jpg" alt="user" class="profile-pic" /></a>
                            {{session('')}}
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                <li><a href="{{url('admin/profile')}}"><i class="ti-user"></i> Profile</a></li>
                                    <li><a href="{{url('admin/logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-bell"></i><span class="hide-menu">Services</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{url('admin/buildings')}}">Building</a></li>
                                <li><a href="{{url('admin/resources')}}">Resources</a></li>
                                <li><a href="{{url('admin/users')}}">Users</a></li>
                                <li><a href="{{url('admin/disableusers')}}">Enable/Disable Users</a></li>
                                <li><a href="{{url('admin/faculty')}}">Faculty</a></li>
                                <!-- // INM 12-04-2019 -->
                                <li><a href="{{url('admin/Clubs_Committees')}}">Clubs/Committees</a></li>
                                <!-- // INM 09-04-2019 -->
                                <li><a href="{{url('admin/bookings')}}">Bookings</a></li> 
                                <li><a href="{{url('admin/inquiry')}}">Inquiry</a></li> 
                                <li><a href="{{url('admin/timetable_slot')}}">Add Timetable Slot</a></li> 
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>