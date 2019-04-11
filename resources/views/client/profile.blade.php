@include('client/common')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <!-- /.row -->
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h3 class="box-title m-b-0">Profile</h3>
                            <p class="text-muted m-b-30 font-13">Update Profile</p>
                            <div class="row">  
                                <div class="col-sm-12 col-xs-12">
                                <form method="post" id="frm_profile">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">User Name</label>
                                            <input type="text" class="form-control" id="txt_username" name="txt_username" placeholder="Enter Username" value="{{@$user->username}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Phone number</label>
                                            <input type="number" class="form-control" id="txt_phoneno" name="txt_phoneno" placeholder="Enter Phoneno" value="{{@$user->phonenumber}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="txt_password" name="txt_password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" class="form-control" id="txt_cpassword" name="txt_cpassword" placeholder="Confirm Password">
                                            <label id="hide_label" class="hid_label" style="color: red;"></label>
                                        </div>
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <br/><br/><h2 id="lbl_success" style="color:blue;display:none">Profile Updated</h2>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            
            <script>
                $(document).ready(function(){
                $.validator.addMethod("phoneno", function(value, element) {
                return this.optional(element) || /^[6-9][0-9]+$/i.test(value);
            }, "Enter valid mobile no");
                $.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-zA-Z_ \s]+$/i.test(value);
                }, "Only alphabetical characters"); 
                $("#frm_profile").validate({
                    rules: {
                        txt_username:{
                            lettersonly:true,
                        },
                        txt_password:{
                            minlength:8,
                        },
                        txt_cpassword: {
                            equalTo: "#txt_password"
                        },
                        txt_phoneno:{
                            minlength: 10,
                            maxlength:10,
                            phoneno:true
                        }
                    }
                });
                $("#frm_profile").submit(function(e){
                    e.preventDefault();
                    if($("#frm_profile").valid())
                    {
                            $.ajax({
                            url: 'updateProfile',
                            type: 'POST',
                            data: $("#frm_profile").serialize()+"&_token={{csrf_token()}}",
                        })
                        .done(function(response) {
                            if(response=="1" || response==1)
                            { 
                                $("#lbl_success").fadeIn(500);
                                $("#lbl_success").fadeOut(5000);
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
            });
            </script>
@include('client/footer')