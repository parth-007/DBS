@include("admin/common")
<link href="{{asset('client/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
<script>
        $(document).ready(function(){
          $(document).on("click",".userstatus",function(){
            var status = ($(this).text());
            var email = ($(this).parent().prev().prev().prev().text());
            $.ajax({
                url:"{{url('admin/AdminDashBoard/status_change/')}}",
                type:"post",
                data:{"status":status,"email":email,}
                success:function(data)
                {
                    if(data==1)
                      $("#a_status_ac").html('Active');  
                    else
                      $("#a_status_iac").html('In-active');  
                    }
                }
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
              <div class="table-responsive m-t-40">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr. No.</th>
                          <th>Email</th>
                          <th>User type</th>
                          <th>PhoneNumber</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $c=0;?>
                      @foreach($users as $user)
                      <tr>
                        <td><?php echo ++$c;?></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->usertype}}</td>
                        <td>{{$user->phonenumber}}</td>
                        <?php if ($user->is_active==1) { ?>
                          <td><a id="a_status_ac" href="#" onclick="change_user_status({{@$user->email}})" class="badge userstatus badge-info" title="Click to change status to 'Inactive'">Active</td>
                        <?php } else { ?>
                          <td><a id="a_status_iac" href="#" onclick="change_user_status({{@$user->email}})" class="badge userstatus badge-danger" title="Click to change status to 'Active'">In-active</td>
                        <?php } ?>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
@include("admin/footer")