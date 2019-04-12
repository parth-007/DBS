@include('admin/common')

    
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Faculties</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Faculty</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-info">Add building</button> -->
                        <button type="button" class="btn btn-info" id="btn_model" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">Add Faculty</button>
                        <div class="container">
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <div class="modal-header">
                                <h4 class="modal-title">Add Faculty</h4>
                                <button type="button"  class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <form action='{{url("admin/add_faculty")}}' method="post" id="frm_add_faculty">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter DAIICT Id:</label>
                                                <input type="text" class="form-control" name="email" id="email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter Name:</label>
                                                <input type="text" class="form-control" name="name" id="name" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter Phone Number:</label>
                                                <input type="number" class="form-control" name="phone" id="phone" required>
                                            </div>
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" id="btnsubmit" class="btn btn-info">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
             <div class="col-lg-9">
                        <div class="card">
                            <div class="card-title">
                                <h4>Faculties</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                	<?php $v=0;?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                               	<th>Phone</th>
                                                <th>Verified</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($f_data as $f)
                                            <tr>
                                                <td><?php echo ++$v;?></td>
                                                <td>{{$f->email}}</td>
                                                <td><span>{{$f->username}}</span></td>
                                                <td><span>{{$f->phonenumber}}</span></td>
                                                <td>@if($f->is_verified) Yes @else No @endif</td>
                                            </tr>
                                            
                                        
                                        @endforeach
                                        </tbody>
                                        {{$f_data->links()}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $.validator.addMethod("phoneno", function(value, element) {
                    return this.optional(element) || /^[6-9][0-9]+$/i.test(value);
                }, "Enter valid mobile no"); 

        $.validator.addMethod("damail", function(value, element) {
                return this.optional(element) || /^[a-z0-9_]+@daiict\.ac\.in$/i.test(value);
            }, "Please Enter Valid DA-IICT Email");

        $("#frm_add_faculty").validate({
            rules:{
                phone:{
                    minlength:10,
                    maxlength:10,
                    phoneno:true,
                },
                email:{
                    damail:true
                }
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
@include('admin/footer')