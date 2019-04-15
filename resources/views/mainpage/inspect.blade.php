<!DOCTYPE html>
<html>

<head>
    <title>DBS | Inspect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="Image/png" href="http://localhost:8000/mainpage/Images/favicon.png">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/fontawesomeWeb/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/basic.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/clockpicker.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/standalone.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="{{asset('mainpage/JS/clockpicker.js')}}"></script>
    

</head>
<script type="text/javascript">
    $(document).ready(function(){
            $('#email').blur(function(){
                
                                                var email=$('#email').val();
                                                var remail=/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                                                if(email.trim()=='')
                                                {
                                                    $('#email').css('border-color','yellow');
                                                    
                                                }else if(remail.test(email)==false)
                                                {
                                                    $('#email').css('border-color','yellow');
                                                   
                                                }else
                                                {
                                                    $('#email').css('border-color','green');
                                                 
                                                }
                                            });

            $('#message').blur(function(){

                                                var message=$('#message').val();
                                                var remsg=/^[A-Za-z0-9 '.,-]{3,250}$/i;
                                                if(message.trim()=='')
                                                {
                                                    $('#message').css('border-color','yellow');
                                                    
                                                }else if(remsg.test(message)==false)
                                                {
                                                    $('#message').css('border-color','yellow');
                                                   
                                                }else
                                                {
                                                    $('#message').css('border-color','green');
                                                 
                                                }
                                            });

            $('#form1').submit(function(e){
            e.preventDefault();
            var flag=[];
            var formData = new FormData($('#form1')[0]);   
            console.log(FormData);
            var email=$('#email').val();
            var emailreg=/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
            var message=$('#message').val();

            if(email=='' || email.trim()=='' || emailreg.test(email)==false)
            {
                $('#email').css('border-color','yellow');
                flag.push('email');
            }
            else
            {
                $('#email').css('border-color','green');
            }

              var message=$('#message').val();
              var remsg=/^[A-Za-z0-9 '.,-]{3,250}$/i;

                if(message=='' || message.trim()=='' || remsg.test(message)==false)
            {
                $('#message').css('border-color','yellow');
                flag.push('msg');
            }
            else
            {
                $('#message').css('border-color','green');
            }              


        if(flag.length==0)
        
             {
             $.ajax({
                    
                      headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
                            url:'{{url("inquiry")}}',
                            type:"POST",
                            data:formData,
                     async: false,   
                       cache: false,
                       contentType: false,
                     
                     
                            processData: false,
                    success:function(data)
                    {
                         $('#msg').fadeIn('slow', function(){
               $('#msg').delay(3000).fadeOut(); 
                $('#email').val('');
               $('#message').val('');
                    
            });
                    }
                });
            }
        });
    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#f2').submit(function(e){
            e.preventDefault();
            var build = $('#building').val();
            var from = $('#from').val();
            var to = $('#to').val();
            var date1 = $('#mybd').val();

            var formData = new FormData($(this)[0]);  
            // console.log(formData);

             $.ajax({
                type:"post",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{url('inspect_slots')}}",
                data:formData,
                 async: false,   
                       cache: false,
                       contentType: false,
                       enctype: 'multipart/form-data',
                       processData: false,

                       success:function(data)
                       {
                            
                             $('#myresult').html(data);
                       }
            });

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
            <center>
                <div id="succ_msg" style="position: fixed;top: 30px; left: 20%; right: 20%; z-index: 2;padding:10px 5px;background: #15C3B6;display: none">
                    <div class="alert alert-success">
                    <strong>Done!</strong> Thank you we will contact you shortly
                    </div>
                </div>
            </center>
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
                <form name="inspect-form" class="inspect-form" method="post" id="f2">
                    {{csrf_field()}}
                    <input type="text" name="mybd" placeholder="Date" style="width: 200px;" onfocus="this.type='date'" id="mybd">
                    <select name="building" style="width: 200px; color: gray;" onchange="this.style.color='white'" id="building">
                        <option value="" selected disabled hidden>Resources</option>
                        @foreach($building as $b)
                        <option value="{{$b->buildingid}}">{{$b->buildingname}}</option>
                        @endforeach
                    </select>
                    <span class="input-group clockpicker">
                        <input type="text" name="timefrom" placeholder="From" class="form-control"
                            style="width: 100px;" readonly id="from" value="">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </span>
                    <span class="input-group clockpicker">
                        <input type="text" name="timeto" class="form-control" placeholder="To" style="width: 100px;"
                            readonly id="to" value="">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </span>
                    <input type="submit" class="btn" value="Go" id="mybtn" style="border-color: white;">
                    <script type="text/javascript">
                        $('.clockpicker').clockpicker();    
                    </script>
                </form>
            </div>
            <div class="inspect-div">
               
                
                <div id="myresult">
                     <h2 style="text-align: center; margin: 0; padding: 50px; opacity: .5;"><i class="fas fa-th-large"
                        style="font-size: 36px;"></i><br>Inspect
                    Resources</h2>
                


                </div>





                

                
                
            </div>
        </div>
    </div>

    <!-- <footer id="contactus">
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
            <form name="contact" method="post" id="form1">
                {{csrf_field()}}
                <h2>Ping Us</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <input type="email" name="email" id="email" required>
                    <label>Email : </label>
                </div>
                <div class="input-grp">
                    <textarea rows="4" cols="40" name="message" style="resize: none;" id="message" required></textarea>
                    <label>Message : </label>
                </div>
                <div class="tx-al-rght">
                    <input type="submit" value="Send" class="btn">
                </div>
                <label class="disp-no">*Sent Successfully.</label>
                <span id="msg" style="display:none;padding-left: 192px;font-size: large;color: white">Message Sent!</span>
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
    </footer> -->
    @include('mainpage\footer')
</body>

</html>