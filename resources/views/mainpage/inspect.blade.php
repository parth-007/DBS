<!DOCTYPE html>
<html>

<head>
    <title>DBS | Inspect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/fontawesomeWeb/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/basic.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/clockpicker.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/standalone.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('mainpage/JS/clockpicker.js')}}"></script>

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
                    <a href="{{url('/')}}#about">
                        About <i class="far fa-question-circle mrg-l5" style=" color: rgb(23, 200, 183);"></i>
                    </a>
                </h4>
            </div>
            <div>
                <h4>
                    <a href="#contactus">
                        Contact us <i class="far fa-paper-plane mrg-l5" style=" color: rgb(23, 200, 183);"></i>
                    </a>
                </h4>
            </div>
            <div>
                <h4>
                    <a href="{{url('login')}}">
                        Login <i class="far fa-user-circle mrg-l5" style="color: rgb(23, 200, 183);"></i>
                    </a>
                </h4>
            </div>
        </div>
    </header>

    <div class="main-content-bg">
        <div class="main-content">
            <div class="load-booking-form">
                <form name="inspect-form" class="inspect-form">
                    <input type="text" name="date" placeholder="Date" style="width: 200px;" onfocus="this.type='date'">
                    <select name="building" style="width: 200px; color: gray;" onchange="this.style.color='white'">
                        <option value="" selected disabled hidden>Resources</option>
                        <option value="CEP">CEP</option>>
                        <option value="LT">LT</option>
                        <option value="LAB">LAB</option>
                        <option value="OAT">OAT</option>
                    </select>
                    <span class="input-group clockpicker">
                        <input type="text" name="time-from" placeholder="From" class="form-control"
                            style="width: 100px;" readonly>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </span>
                    <span class="input-group clockpicker">
                        <input type="text" name="time-to" class="form-control" placeholder="To" style="width: 100px;"
                            readonly>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </span>
                    <input type="submit" class="btn" value="Go" style="border-color: white;">
                    <script type="text/javascript">
                        $('.clockpicker').clockpicker();
                    </script>
                </form>
            </div>
            <div class="inspect-div">
                <h2 style="text-align: center; margin: 0; padding: 50px; opacity: .5;"><i class="fas fa-th-large"
                        style="font-size: 36px;"></i><br>Inspect
                    Resources</h2>
                <h2 style="text-align: center; margin: 0; padding: 50px; opacity: .5;"><i class="fas fa-search"
                        style="font-size: 36px;"></i><br>No Match Found</h2>
                <div class="card">
                    <h3 class="tx-al-cntr">CEP 108</h3>
                    <table class="v-al-top-all" cellspacing="10px">
                        <tr>
                            <th>Time: </th>
                            <td>18:00 to 20:00</td>
                        </tr>
                        <tr>
                            <th>Booked by: </th>
                            <td>Parth Mangukia</td>
                        </tr>
                        <tr>
                            <th>Contact: </th>
                            <td>+91-9876543210<br>201812014@daiict.ac.in</td>
                        </tr>
                        <tr>
                            <th>Description: </th>
                            <td>Booked for Radio project of subject Communication skill.</td>
                        </tr>
                    </table>
                </div>
                <!-- <div class="card">
                    <h3 class="tx-al-cntr">LT1</h3>
                    <table class="v-al-top-all" cellspacing="10px">
                        <tr>
                            <th>Time: </th>
                            <td>18:00 to 20:00</td>
                        </tr>
                        <tr>
                            <th>Booked by: </th>
                            <td>Parth Mangukia</td>
                        </tr>
                        <tr>
                            <th>Contact: </th>
                            <td>+91-9876543210<br>201812014@daiict.ac.in</td>
                        </tr>
                        <tr>
                            <th>Description: </th>
                            <td>Booked for Radio project of subject Communication skill.</td>
                        </tr>
                    </table>
                </div> -->
            </div>
        </div>
    </div>

    <footer id="contactus">
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
        </div>
        <div class="contact-frm">
            <form name="contact">
                <h2>Ping Us</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <input type="email" required>
                    <label>Email : </label>
                </div>
                <div class="input-grp">
                    <textarea rows="4" cols="40" name="message" style="resize: none;" required></textarea>
                    <label>Message : </label>
                </div>
                <div class="tx-al-rght">
                    <input type="submit" value="Send" class="btn" style="border-color: white;">
                </div>
                <label class="disp-no">*Sent Successfully.</label>
            </form>
        </div>
        <div class="contact-info tx-al-lft">
            <h2>Contact Us</h2>
            <div style="margin-top: 60px;">
                <p><b>Mobile no.:</b></p>
                <p>+91-9876543210</p><br>
                <p><b>Email: </b></p>
                <p>bookresources@daiict.ac.in</p>
            </div>
        </div>
    </footer>
</body>

</html>