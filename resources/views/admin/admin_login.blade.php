
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Ela - Bootstrap Admin Dashboard Template</title>
  
    <link href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/lib/calendar2/semantic.ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <style type="text/css">
        .hid_label {
            visibility: hidden;
        }
    </style>
    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#admin_button").click(function(){
            var mail = $('#mail').val();
            var password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: '/admin/log_check',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { 'mail': mail,'password': password },
                success: function(msg) {
                    if(msg == 1)
                    {
                        // alert("wrong");
                        $("#hide_label").removeClass("hid_label");
                    }
                    else
                    {
                        window.location = "dashboard";
                    }
                }
            });
        });
        });
    </script>
</head>

<body class="" style="margin: 0; width: 100vw; height: 100vh; background: rgb(215, 226, 255)">

    <div class="row justify-content-center">
        <div class="card col-lg-3 m-t-100">
            <div class="card-outline-info m-t-30 m-r-30 m-l-30 m-b-30">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Admin Login</h4>
                </div>
                <form method="post">
                    {{csrf_field()}}
                    <div class="form-group m-t-15">
                        <label>Email address</label>
                        <input type="email" id="mail" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password">
                        <label id="hide_label" class="hid_label" style="color: red;">*Incorrect login information.</label>
                    </div>
                    <label class="pull-right">
                        <a href="#">Forgotten Password?</a>
                    </label>
                    <button type="button" id="admin_button" class="btn btn-inverse pull-center m-b-30 m-t-30">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- End Wrapper -->
    <!-- All Jquery -->
    <!-- <script src="js/lib/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap tether Core JavaScript -->
    <!-- <script src="js/lib/bootstrap/js/popper.min.js"></script> -->
    <!-- <script src="js/lib/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <!-- <script src="js/jquery.slimscroll.js"></script> -->
    <!--Menu sidebar -->
    <!-- <script src="js/sidebarmenu.js"></script> -->
    <!--stickey kit -->
    <!-- <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> -->
    <!--Custom JavaScript -->
    <!-- <script src="js/custom.min.js"></script> -->
     <script src="{{asset('admin/js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('admin/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('admin/js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->


    <!-- Amchart -->
     <script src="{{asset('admin/js/lib/morris-chart/raphael-min.js')}}"></script>
    <script src="{{asset('admin/js/lib/morris-chart/morris.js')}}"></script>
    <script src="{{asset('admin/js/lib/morris-chart/dashboard1-init.js')}}"></script>


    <script src="{{asset('admin/js/lib/calendar-2/moment.latest.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/semantic.ui.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/prism.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('admin/js/lib/calendar-2/pignose.init.js')}}"></script>

    <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
    <script src="{{asset('admin/js/scripts.js')}}"></script>
    <!-- scripit init-->

    <script src="{{asset('admin/js/custom.min.js')}}"></script>

</body>

</html>