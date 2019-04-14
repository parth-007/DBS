<style type="text/css">
        .error{
            color:red;
        }
    </style>
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
            <form id="frm_pingus" name="pingus" method="post">
                <h2>Ping Us</h2>
                <hr style="border: none; background: rgba(255, 255, 255, 0.3); height: .5px;">
                <div class="input-grp">
                    <input type="email" name="txt_ping_email" required>
                    <label>Email : </label>
                </div>
                <div class="input-grp">
                    <textarea rows="4" cols="40" name="txt_message" style="resize: none;" required></textarea>
                    <label>Message : </label>
                </div>
                <div class="tx-al-rght">
                    <input type="submit" style="border: 1px solid white;" value="Send" class="btn">
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
    <script type="text/javascript">
    $(document).ready(function($) {
        $("#frm_pingus").validate({
            errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertBefore(element);
            }
            }
        });  

        $("#frm_pingus").submit(function(e){
            e.preventDefault();
            if($("#frm_pingus").valid())
            {
                $.ajax({
                    url: 'addinquiry',
                    type: 'POST',
                    data: $("#frm_pingus").serialize()+"&_token="+"{{csrf_token()}}",
                })
                .done(function(response) {
                    if(response=="1" || response==1)
                    {
                        $("#frm_pingus").trigger("reset");
                        $("#succ_msg").fadeIn();
                        $("#succ_msg").fadeOut(4000);
                    }
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        }); 
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        @if($errors->any())
            $("#error_msg").fadeOut(3000);
        @endif
    });
</script>