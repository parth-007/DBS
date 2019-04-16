@include("admin/common")
<link href="{{asset('client/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
<script>
        $(document).ready(function(){
        //INM 07-04-2019
        $("#btn_inactive").prop('disabled',true);
        $("#btn_active").prop('disabled',true);
        $(document).on("click",".status_update",function(){
        var str=$("#txtsearch").val();
        var selpattern=$("#selpattern").val();
        if($(this).text()=="Enable all"){
            var status=1;
        }
        else if($(this).text()=="Disable all"){
            var status=0;
        }
        if(selpattern!=-1 && str!=""){
                $.ajax({
                url: '{{url('admin/AdminDashBoard/multiplestudentstatusupdate')}}',
                type: 'POST',
                dataType: 'json',
                data: {'selpattern':selpattern,'str': str,'status':status,'_token':'{{csrf_token()}}'},
            })
            .done(function(response) {
                console.log("success");    
            })
            .fail(function() {
                console.log("error");
            })
            .always(function(response) {
                if(response["responseText"]=="" || response["responseText"]==null)
                {
                $(".user_data").html("No data matches your search...");
                }
                else
                {
                $(".user_data").html(response["responseText"]);
                }
                console.log("complete");
                });
        }
        });  
        //INM 08-04-2019
        $(document).on("change","#selpattern",function(){
            $("#txtsearch").val("");
        });
        //INM 07-04-2019
        $(document).on("keyup","#txtsearch",function(){
        var str=$(this).val();
        var selpattern=$("#selpattern").val();
        if(str=="")
        {
            $("#btn_inactive").prop('disabled',true);
            $("#btn_active").prop('disabled',true);
        }
        else{
            $("#btn_inactive").prop('disabled',false);
            $("#btn_active").prop('disabled',false);
        }
        if(selpattern!=-1 ){
            // && str!=""
                $.ajax({
                url: '{{url('admin/AdminDashBoard/showBySearchPattern')}}',
                type: 'POST',
                dataType: 'json',
                data: {'selpattern':selpattern,'str': str,'_token':'{{csrf_token()}}'},
            })
            .done(function(response) {
                console.log("success");    
            })
            .fail(function() {
                console.log("error");
            })
            .always(function(response) {
                if(response["responseText"]=="" || response["responseText"]==null)
                {
                $(".user_data").html("No data matches your search...");
                }
                else
                {
                $(".user_data").html(response["responseText"]);
                }
                console.log("complete");
                });
        }
        });
      });
        
</script>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Able/Disable Users</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Enable/Disable Users</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select id="selpattern" class="form-control custom-select">
                            <option value="-1">--Select pattern--</option>
                            <option value="1">Match from start</option>
                            <option value="2">Match from end</option>
                            <option value="3">Match exact</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="txtsearch" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" id="btn_active" class="btn btn-info waves-effect waves-light status_update" >Enable all</button>
                    <button type="button" id="btn_inactive" class="btn btn-danger waves-effect waves-light status_update">Disable all</button>
                </div>
            </div>
            @if($errors->any())
                <center>
                    <div id="error_msg" style="position: fixed;top: 52px; left: 20%; right: 20%; z-index: 9999;background: #cc0000;color:white"><div class="alert alert-error">
                            <strong>Error!</strong> 
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                        </div>
                    </div>
                </center>
            @endif 
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>Email</th>
                          <th>User-name</th>
                          <th>User-type</th>
                          <th>PhoneNumber</th>
                          <th>Is_verified</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody id="user_data" class="user_data">
                      <?php $c=0;?>
                      @foreach($users as $user)
                      <tr>
                        <td><?php echo ++$c;?></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->usertype}}</td>
                        <td>{{$user->phonenumber}}</td>
                        <?php if ($user->is_verified==1) { ?>
                          <td>Yes</td>
                        <?php } else { ?>
                          <td>No</td>
                        <?php } ?>
                        <?php if ($user->is_active==1) { ?>
                          <td>Active</td>
                        <?php } else { ?>
                          <td>In-active</td>
                        <?php } ?>
                      </tr>
                      @endforeach
                      <tr> 
                      <td colspan="7">{{$users->render()}}</td>
                      </tr>
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        @if($errors->any())
            $("#error_msg").fadeOut(3000);
        @endif
    });
  </script>
@include("admin/footer")