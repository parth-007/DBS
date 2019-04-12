
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

    <!-- <link href="{{asset('admin/css/lib/calendar2/semantic.ui.min.css')}}" rel="stylesheet"> -->
    <!-- <link href="{{asset('admin/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet"> -->
    <!-- <link href="{{asset('admin/css/lib/owl.carousel.min.css')}}" rel="stylesheet" /> -->
    <!-- <link href="{{asset('admin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" /> -->
    <link href="{{asset('admin/css/helper.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('admin/css/style.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
            $("#fog_span").click(function(){
                $.ajax({
                type: 'POST',
                url: '/admin/forget_password',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(msg) {
                }
            });    
            });
        });
    </script>
</head>

<body class="" style="margin: 0; width: 100vw; height: 100vh;">

    <div class="row justify-content-center"  >
        <div class="card col-lg-3 m-t-100" style="background-color: rgb(60, 60, 60);color: white;height: 400px;">
            <div class="card-outline-info m-t-30 m-r-30 m-l-30 m-b-30">
                <div class="card-header">
                    <h4>Admin Login</h4>
                </div>
                <form method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" id="mail" class="form-control" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password" required="required">
                        <label id="hide_label" class="hid_label" style="color: red;">*Incorrect login information.</label>
                    </div>
                    <label class="pull-right">
                        <span id="fog_span" data-toggle="modal" data-target="#myModal">Forgotten Password?</span>

                    </label>
                    <br>
                    <button type="button" id="admin_button" class="btn btn-default" >Login</button>
                </form>
                <div class="container" style="color: black;">
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="color: black;">Forgot Password</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body" style="color: black;">
                          <p>Please check your E-mail</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('admin/js/custom.min.js')}}"></script>

</body>

</html>