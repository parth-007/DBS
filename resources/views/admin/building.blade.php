@include("admin/common")
<!-- <script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script src="js/lib/sweetalert/sweetalert.init.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
<link href="{{asset('client/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
<script>
        function fetch_account(aid){
            $.ajax({
                url:"{{url('admin/AdminDashBoard/fetch_account/')}}"+'/'+aid,
                type:"get",
                success:function(data)
                {
                    $("#btnsubmit_update").html('Update');
                    var ob=JSON.parse(data);
                    $("#uid").val(ob.buildingid);
                    $("#buildingname_update").val(ob.buildingname);
                }
            });
        }
        $(document).ready(function(){
            $("#frm_Add").validate({
                
            });
        });

</script>

<div class="page-wrapper">
        
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Buildings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Buildings</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                            
                        <!-- <button type="button" class="btn btn-info">Add building</button> -->
                        <button type="button" class="btn btn-info" id="btn_model" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">Add building</button>
                        <div class="container">
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <div class="modal-header">
                                <h4 class="modal-title">Add building</h4>
                                <button type="button"  class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <form action='{{url("admin/buildings/insertbuilding")}}' id="frm_Add" method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Building name:</label>
                                                <input type="text" class="form-control" name="buildingname" placeholder="Add building" id="buildingname" required/>
                                            </div>
                                    </div>
                                    <input type="hidden" name="aid" id="aid">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" id="btnsubmit" class="btn btn-info">Add building</button>
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
            <div class="table-responsive m-t-40">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Building-id</th>
                            <th>Building-name</th>
                            <th style="text-align:center" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($buildings as $building)
                            <tr>
                                <td id="bid">{{ $building->buildingid}}</td>
                                <td>{{ $building->buildingname}}</td>
                                <td style="text-align:center"><a data-toggle="modal" data-target="#myModal_update" data-backdrop="static"
                                data-keyboard="false" href="" onclick="fetch_account({{@$building->buildingid}})" data-toggle="modal" data-target="#myModal_update" data-whatever="@mdo" class="fa fa-edit f-s-30 color-info"></a></td>

                                <!-- <button type="button" class="btn btn-info" id="btn_model" data-toggle="modal" data-target="#myModal_update" data-whatever="@mdo">Add building</button> -->
                            <div class="container">
                            <div class="modal" id="myModal_update">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <div class="modal-header">
                                <h4 class="modal-title">Update building</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <form action='{{url("admin/buildings/updatebuilding")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Building name:</label>
                                                <input type="text" class="form-control" name="buildingname" id="buildingname_update">
                                            </div>
                                    </div>
                                    <input type="hidden" name="uid" id="uid">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" id="btnsubmit_update" class="btn btn-info">Update building</button>
                                    </div>
                                </form>
                            </div>
                        </div>    
                                <td style="text-align:center"><a href='{{ url("admin/buildings/delete/{$building->buildingid}")}}' class="fa fa-trash f-s-30 color-danger"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        @if($errors->any())
            $("#error_msg").fadeOut(4000);
        @endif
    });
</script>
@include("admin/footer")