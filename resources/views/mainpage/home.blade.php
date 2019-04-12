<!DOCTYPE html>
<html>

<head>
    <title>DBS | DA Booking System  - Book Any Place Any Time</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="Image/png" href="http://localhost:8000/mainpage/Images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/fontawesomeWeb/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/main.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('mainpage/CSS/basic.css')}}" />

    <script src="{{asset('mainpage/JS/home-slider.js')}}"></script>
    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
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
                <h3 class="mrg-l20 disp-no">Welcome User</h3>
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
    <div class="slideshow-container">

        <div class="mySlides fade" style="display: block;">
            <picture>
                <source srcset="{{asset('mainpage/Images/banner1-small.jpg')}}" media="(max-width: 800px)">
                <source srcset="{{asset('mainpage/Images/banner1.jpg')}}">
                <img src="{{asset('mainpage/Images/banner1.jpg')}}" style="width:100%; min-width: 400px;">
            </picture>
            <div class="text"><a href="{{url('inspect')}}"><button class="btn">Inspect Now</button></a></div>
        </div>

        <div class="mySlides fade">
            <picture>
                <source srcset="{{asset('mainpage/Images/banner2-small.jpg')}}" media="(max-width: 800px)">
                <source srcset="{{asset('mainpage/Images/banner2.jpg')}}">
                <img src="{{asset('mainpage/Images/banner3.jpg')}}" style="width:100%; min-width: 400px;">
            </picture>
            <div class="text"><a href="{{url('client/booking')}}"><button class="btn">Book Now</button></a></div>
        </div>

        <div class="mySlides fade">
            <picture>
                <source srcset="{{asset('mainpage/Images/banner3-small.jpg')}}" media="(max-width: 800px)">
                <source srcset="{{asset('mainpage/Images/banner3.jpg')}}">
                <img src="{{asset('mainpage/Images/banner3.jpg')}}" style="width:100%; min-width: 400px;">
            </picture>
            <div class="text"><a href="{{url('login')}}"><button class="btn">Login</button></a></div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>

    <div style="text-align:center; margin-top: 0px;">
        <span class="dot active" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <div class="about-content" id="about">
        <div class="img-div">
            <img src="{{asset('mainpage/Images/about.png')}}">
        </div>
        <div class="info-div">
            <p class="about-ttl">ABOUT</p>
            <span style="text-align: left;">
                Hello, Welcome to DA Booking System. It is online facility to book the CEP, LT, LAB, etc.
                Every information of the resources is provided on this website. You just have to register yourself,
                and go to the booking page. You can see the empty and booked slots of resources with each and every
                information that you want to know.
            </span>
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
                <!-- <label class="disp-no">*Sent Successfully.</label> -->
                <span id="msg" style="display:none;padding-left: 192px;font-size: large;color: white">Message Sent!</span>
            </form>
        </div>
        <div class="contact-info tx-al-lft">
            <h2>Contact Us</h2>
            <div style="margin-top: 60px;">
                <p><b>Mobile no.:</b></p>
                <p>+91-9876543210</p><br>
                <p><b>Email: </b></p>
                <p>daiictbooking@gmail.com</p>
            </div>
        </div>
    </footer>
</body>

</html>
