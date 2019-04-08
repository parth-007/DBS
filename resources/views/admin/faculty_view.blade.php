@include('admin/common')
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Faculties</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
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
                                
                                <form action='{{url("admin/add_faculty")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter DAIICT Id:</label>
                                                <input type="text" class="form-control" name="email" id="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter Name:</label>
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Enter Phone Number:</label>
                                                <input type="text" class="form-control" name="phone" id="phone">
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($f_data as $f)
                                            <tr>
                                                <td><?php echo ++$v;?></td>
                                                <td>{{$f->email}}</td>
                                                <td><span>{{$f->username}}</span></td>
                                                <td><span>{{$f->phonenumber}}</span></td>
                                                
                                            </tr>
                                            
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
@include('admin/footer')