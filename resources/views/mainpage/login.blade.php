<!DOCTYPE html>
<html>

<head>
    <title>DBS | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/fontawesomeWeb/css/all.css')}}" />

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/basic.css')}}" />
    <style>
        .error{
            color:red;
        }
    </style>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<script type="text/javascript">
    function pop_up() {
    // alert("Hi");
    document.body.style.overflow = "hidden";
    document.getElementById('pop-up').className = "popup-show";
    }

    function pop_down() {
        // alert("Hi");
        document.body.style.overflow = "auto";
        document.getElementById('pop-up').className = "popup-hid";
    }
    $(document).ready(function(){
    $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z\s]+$/i.test(value);
            }, "Only alphabetical characters");
        
        $("#signup").validate({
            rules:{
                name2:{
                    lettersonly:true,
                },
                password2:{
                    minlength:8,
                },
                password3:{
                    equalTo:"#password2",
                },
                mobile2:{
                    minlength:10,
                    maxlength:10,
                }
            },
            errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertBefore(element);
            }
            }   
        });
        $("#mail2").blur(function(){
            var mail = $("#mail2").val();
            $.ajax({
                type: 'POST',
                url: '/dup_mail',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { 'mail': mail },
                success: function(msg) {
                    if(msg == 1)
                    {
                        $("#dup_label").removeClass("disp-no");
                    }
                    else
                    {
                        $("#dup_label").addClass("disp-no");
                    }
                }
            });
        });
        //
        $("#popup_email").blur(function(e){
            e.preventDefault();
            var mail = $("#popup_email").val();
                $.ajax({
                    type: 'POST',
                    url: '/client/reset_mail',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { 'mail': mail },
                    success: function(msg) {
                        if(msg != 1)
                        {
                            $("#res_mail").removeClass("disp-no");
                        }
                        else
                        {
                            $("#res_mail").addClass("disp-no");
                        }
                    }
                });
        });
        $("#login").validate({
            errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertBefore(element);
            }
            } 
        });
        $("#login").submit(function(e){
            e.preventDefault();
            var mail = $('#mail').val();
            var password = $('#password').val();
            if($("#login").valid()){
                $.ajax({
                    type: 'POST',
                    url: '/log_check',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { 'mail': mail,'password': password },
                    success: function(msg) {
                        if(msg == 1)
                        {
                            $("#dup_log_label").removeClass("disp-no");
                        }
                        else
                        {
                            window.location = "/dashboard";
                        }
                    }
                });
            }
        });
    });
</script>
<body>
    <header>
        <div class="fl-lft hdr-div">
            <div>
                <a href="{{url('/')}}">
                    <img src="{{asset('mainpage/Images/DBS1.png')}}" alt="dbs">
                </a>
            </div>
            <div>
                <a href="{{url('/')}}">
                    <h2 class="hdr-ttl">DBS</h2>
                </a>
            </div>
            <div>
                <h3 class="mrg-l20">Welcome User</h3>
            </div>
        </div>
        <div class="fl-rght hdr-div">
            <div>
                <h4>
                    <a href="#about">
                        About <i class="far fa-question-circle mrg-l5" style=" color: rgb(23, 200, 183);"></i>
                    </a>
                </h4>
            </div>
        </div>
    </header>
    <br><br>
    <input type="radio" name="flag" id="lgn-form" class="disp-no" checked>
    <label for="lgn-form" class="mrg20 btn-radio">Want to Login</label>

    <input type="radio" name="flag" id="sgn-form" class="disp-no">
    <label for="sgn-form" class="mrg20 btn-radio">Want to Sign Up</label>

    <div class="flx-div"
        style="background-image: url('{{asset('mainpage/Images/lgbg.jpg')}}'); background-size: 100%; background-repeat: no-repeat; background-position-y: center;">
        <div class="frm-lgn">
            <form name="login" id="login" method="post">
                 {{csrf_field()}}
                <h2>Login</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <label class="disp-no">*Mail ID not valid</label>
                    <input type="email" id="mail" name="mail" required>
                    <label>DA Mail-ID : </label>
                </div>
                <div class="input-grp">
                    <label id="dup_log_label" class="disp-no" style="color: red;">*Incorrect login information.</label>
                    <input type="password" id="password" name="password" required>
                    <label>Password : </label>
                </div>
                <div>
                    <span style="text-decoration: underline; cursor: pointer;" onclick="pop_up();">
                        Forgot Password
                    </span>
                </div>
                <div class="tx-al-rght">
                    <input type="submit" id="login_button" name="login" value="Login" class="btn">
                </div>
            </form>
        </div>
        <div class="frm-lgn">
            <form name="signup" id="signup" action="\signup" method="post">
                {{csrf_field()}}
                <h2>Sign Up</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <label class="disp-no" id="dup_label" style="color: red;">*This email is already in our network</label>
                    <input type="email" name="mail2" id="mail2" required>
                    <label>DA Mail-ID : </label>
                </div>
                <div class="input-grp">
                    <input type="text" name="name2" id="name2" required>
                    <label>Name : </label>
                </div>

                <!-- <div class="flx-div" style="justify-content: space-between;">
                    <div class="input-grp">
                        <input type="text" name="fname2" style="width: 130px;" required>
                        <label>First Name : </label>
                    </div>
                    <div class="input-grp">
                        <input type="text" name="lname2" style="width: 130px;" required>
                        <label>Last Name : </label>
                    </div>
                </div> -->

                <!-- <div class="input-grp">
                    <div class="flx-div lbl-style mrg5" style="justify-content: space-around;">
                        <span>
                            <input type="radio" name="gen" id="frm-male" class="disp-n" style="opacity: 0;" required>
                            <label for="frm-male">
                                <i class="fas fa-male" style="font-size: 30px; cursor: pointer;"></i>
                            </label>
                        </span>
                        <span>
                            <input type="radio" name="gen" id="frm-female" class="disp-n" style="opacity: 0;" required>
                            <label for="frm-female">
                                <i class="fas fa-female" style="font-size: 30px; cursor: pointer;"></i>
                            </label>
                        </span>
                    </div>
                    <label class="gndr-ttl">Gender : </label>
                </div> -->

                <div class="input-grp">
                    <input type="password" name="password2" id="password2" required>
                    <label>Password : </label>
                </div>
                <div class="input-grp">
                    <input type="password" name="password3" id="password3" required>
                    <label>Re-Enter Password : </label>
                </div>
                <div class="input-grp">
                    <input type="number" name="mobile2" id="mobile2" required>
                    <label>Mobile No. : </label>
                </div>

                <div class="tx-al-rght">
                    <input type="submit" name="signup" value="Sign Up" class="btn">
                </div>
            </form>
        </div>
    </div>
    <!-- Popup division starts -->
    <div id="pop-up" class="popup-hid">
        <div class="popup-div">
            <h2 style="display: flex; justify-content: space-between; margin: 0;">
                <span>Enter Email</span>
                <span style="padding: 0 5px; cursor: pointer;" onclick="pop_down();">&times;</span>
            </h2>
            <form action="\client\forget_pass" method="post" name="popup-form" class="tx-al-cntr">
                 {{csrf_field()}}
                <label class="mrg-r20">Enter DA-Mail ID </label>
                <input type="text" name="popup_email" id="popup_email" placeholder="Mail-ID" required=""><br>
                <p class="tx-al-lft disp-no" id="res_mail" style="color: red;">*Email is not acquired by any user</p>
                <p><input class="btn" type="submit" value="Submit"></p>
            </form>
        </div>
    </div>
    <!-- Pop division end -->
</body>

</html>