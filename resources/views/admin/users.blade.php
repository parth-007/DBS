@include("admin/common")
<script>
        $(document).ready(function(){
          //INM 06-04-2019
          $(document).on("keyup","#txtsearch",function(){
            var str=$(this).val();
            $.ajax({
            url: '{{url('admin/AdminDashBoard/showHint')}}',
            type: 'POST',
            dataType: 'json',
            data: {'str': str,'_token':'{{csrf_token()}}'},
          })
          .done(function(response) {
            // alert(response);
            
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
          });

          $(document).on("click",".userstatus",function(){
            var status = 1;
            var hold=$(this);
            if($(this).text()=="Active")
              status = 0; 
            var email = ($(this).parent().prev().prev().prev().prev().prev().text());
            $.ajax({
            url: '{{url('admin/AdminDashBoard/status_change/')}}',
            type: 'POST',
            dataType: 'json',
            data: {'email': email,'status':status,'_token':'{{csrf_token()}}'},
          })
          .done(function(response) {
            
            console.log("success");
          })
          .fail(function() {
            console.log("error");
          })
          .always(function(response) {
            if(response==1 || response=="1")
            {
              if(status==1)
                hold.parent().html('<a href="#" class="badge userstatus badge-info">Active');
              else
                hold.parent().html('<a href="#" class="badge userstatus badge-danger">In-Active');
            }
            console.log("complete");
          });
          });
      });
        
</script>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Users</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
              <div class="col-md-3">
                <div class="form-group">
                    <input type="text" id="txtsearch" class="form-control"  placeholder="Type to search...">
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
                          <td><a href="#" class="badge userstatus badge-info" title="Click to change status to 'Inactive'">Active</td>
                        <?php } else { ?>
                          <td><a href="#" class="badge userstatus badge-danger" title="Click to change status to 'Active'">In-active</td>
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