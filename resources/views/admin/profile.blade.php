@include("admin/common")
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script>
        function updateHandler(update_id){
            

        }
        </script>
        
    </head>
<body>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Resource</h3> 
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Resource</li>
                    </ol>
                </div>
            </div>
        <div class="container-fluid">
            <div class="table-responsive m-t-40">
                    <form id="frm_profile" method="post">
                            <div>
                                <label for="username">Username</label>
                            <input type="text" class="form-control" id="txt_username" name="txt_username" value="{{$user->username}}" required>
                            </div><br/>
                            <div>
                                    <label for="phoneno">Phone no</label>
                                    <input type="number" class="form-control" id="txt_phoneno" name="txt_phoneno" value="{{$user->phone}}" required>
                            </div><br/>
                            <div>
                                    <label for="password">password</label>
                                    <input type="password" class="form-control" id="txt_password" name="txt_password">
                            </div><br/>
                            <div>
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="password" class="form-control" id="txt_cpassword" name="txt_cpassword">
                                    <label id="hide_label" class="hid_label" style="color: red;"></label>
                            </div><br/>
                            <button type="submit" class="btn btn-info">Update</button>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>


    </body>
    <script>
            $("#frm_profile").submit(function(e){
                e.preventDefault();
                if($("#txt_password").val()!=$("#txt_cpassword").val())
                {
                    $("#hide_label").text("Password doesn't match");
                }
                else
                {
                    $("#hide_label").text("");
                    $.ajax({
                    url: '{{url("admin/updateProfile")}}',
                    type: 'POST',
                    data: $("#frm_profile").serialize()+"&_token={{csrf_token()}}",
                })
                .done(function(response) {
                    if(response=="1" || response==1)
                    {
                        //window.location="/dashboard";
                        alert("Profile updated");
                    }
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("always");
                });
                }
            });
        </script>
    </html>

@include("admin/footer")