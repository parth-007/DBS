<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/monster-admin/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 Jan 2018 09:55:31 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
   <!--  <link href="{{asset('client/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <script src="{{asset('client/assets/plugins/jquery/jquery.min.js')}}"></script> -->
    <script type="text/javascript">
    // $(document).ready(function(){
    	// $.validator.addMethod("lettersonly", function(value, element) {
     //            return this.optional(element) || /^[a-z\s]+$/i.test(value);
     //        }, "Only alphabetical characters");
    	// $("#reset_frm").validate({
    	// 	rules:{
    	// 		password:{
     //                minlength:8,
     //            },
     //            password1:{
     //                equalTo:"#password2",
     //            }
     //        },	
     //        errorPlacement: function(error, element) {
     //        var placement = $(element).data('error');
     //        if (placement) {
     //            $(placement).append(error)
     //        } else {
     //            error.insertBefore(element);
     //        }
     //        } 
     //    });
    //     $("#reset_frm").validate({
    //         rules:{
    //             password:{
    //                 minlength:8,
    //             },
    //             password1:{
    //                 equalTo:"#password2",
    //             }
    //         },
    //         errorPlacement: function(error, element) {
    //         var placement = $(element).data('error');
    //         if (placement) {
    //             $(placement).append(error)
    //         } else {
    //             error.insertBefore(element);
    //         }
    //         }   
    //     });
    // });
    </script>
    <style type="text/css">
	.login-form {
		width: 340px;
    	margin: 100px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form" id="reset_frm">
    <form id="" action="\client\reset" method="post">
    	{{csrf_field()}}
        <h2 class="text-center">Reset Password</h2>       
        <div class="form-group">
            <input type="password" id="password" name="password"  class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" id="password1" name="password1" class="form-control" placeholder="Re-Enter Password" required="required">
        </div>
        <div class="form-group">
            <input type="text" style="visibility: hidden;" id="mail" name="mail" class="form-control" required="required" value={{@$user}}>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Reset</button>
        </div>
    </form>
</div>

    <!-- <script src="{{asset('client/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> -->
</body>
</html>