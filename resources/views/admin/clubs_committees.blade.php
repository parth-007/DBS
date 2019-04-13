@include('admin/common')
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Clubs/Committees</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Clubs/Committees</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-info" id="btn_model" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">Add Club/Committee</button>
                        <div class="container">
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <div class="modal-header">
                                <h4 class="modal-title">Add Club/Committee</h4>
                                <button type="button"  class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <form action='{{url("admin/insert_club_committee")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                    <div class="form-group">
                                        <label for="lblclubs_committees">Select  :</label>
                                            <select class="form-control custom-select" name="selclubs_committees" id="selclubs_committees">
                                                @foreach($sel_c_c as $sel)
                                                    <option value="{{$sel->usertypeid}}">{{$sel->usertype}}</option>
                                                @endforeach 
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="lblemail" class="col-form-label">Enter DAIICT-EMAIL Id:</label>
                                            <input type="text" class="form-control" name="email" id="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="lblname" class="col-form-label">Enter User Name:</label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="lblphno" class="col-form-label">Enter Phone Number:</label>
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

             <div class="col-lg-9">
                        <!-- <div class="card"> -->
                            <!-- <div class="card-body"> -->
                                <div class="table-responsive m-t-40">
                                	<?php $v=0;?>
                                    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                               	<th>Phone</th> 
                                                <th>Usertype</th>   
                                                <th>Is-Verified</th> 
                                                <th>Is-Active</th>     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($c_c as $users)
                                                <tr>
                                                    <td><?php echo ++$v;?></td>
                                                    <td>{{$users->email}}</td>
                                                    <td>{{$users->username}}</td>
                                                    <td>{{$users->phonenumber}}</td>
                                                    <td>{{$users->usertype}}</td>
                                                    <?php if ($users->is_verified==1) { ?>
                                                    <td>Yes</td>
                                                    <?php } else { ?>
                                                    <td>No</td>
                                                    <?php } ?>
                                                    <?php if ($users->is_active==1) { ?>
                                                    <td>Active</td>
                                                    <?php } else { ?>
                                                    <td>In-active</td>
                                                    <?php } ?>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="7">{{$c_c->render()}}</td>
                                            </tr>
                                        </tbody>    
                                    </table>
                                </div>
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>

        </div>
    </div>
</div>
@include('admin/footer')
