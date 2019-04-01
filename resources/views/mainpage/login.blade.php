<!DOCTYPE html>
<html>

<head>
    <title>DBS | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/fontawesomeWeb/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/basic.css')}}" />

</head>

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
            <form name="login">
                <h2>Login</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <label class="disp-no">*Mail ID not valid</label>
                    <input type="email" name="mail" required>
                    <label>DA Mail-ID : </label>
                </div>
                <div class="input-grp">
                    <label class="disp-no">*Incorrect login information.</label>
                    <input type="password" name="password" required>
                    <label>Password : </label>
                </div>
                <div class="tx-al-rght">
                    <input type="submit" name="login" value="Login" class="btn">
                </div>
            </form>
        </div>
        <div class="frm-lgn">
            <form name="signup">
                <h2>Sign Up</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <input type="email" name="mail2" required>
                    <label>DA Mail-ID : </label>
                </div>
                <div class="input-grp">
                    <input type="text" name="name2" required>
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
                    <input type="password" name="password2" required>
                    <label>Password : </label>
                </div>
                <div class="input-grp">
                    <input type="number" name="mobile2" required>
                    <label>Mobile No. : </label>
                </div>

                <div class="tx-al-rght">
                    <input type="submit" name="signup" value="Sign Up" class="btn">
                </div>
            </form>
        </div>
    </div>
</body>

</html>