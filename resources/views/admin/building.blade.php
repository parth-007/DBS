@include("admin/common")
<!-- <script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script src="js/lib/sweetalert/sweetalert.init.js"></script> -->


<link href="{{asset('client/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
<script>
        function fetch_account(aid){
            $.ajax({
                url:"{{url('admin/AdminDashBoard/fetch_account/')}}"+'/'+aid,
                type:"get",
                success:function(data)
                {
                    $("#btnsubmit").html('Update');
                    var ob=JSON.parse(data);
                    $("#aid").val(ob.buildingid);
                    $("#buildingname").val(ob.buildingname);
                }
            });
        }
        
</script>

<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Buildings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
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
                                
                                <form action='{{url("admin/buildings/insertbuilding")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <label for="building" class="col-form-label">Building name:</label>
                                                <input type="text" class="form-control" name="buildingname" id="buildingname">
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

            <div class="table-responsive m-t-40">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Building-id</th>
                            <th>Building-name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($buildings as $building)
                            <tr>
                                <td id="bid">{{ $building->buildingid}}</td>
                                <td>{{ $building->buildingname}}</td>
                                <td><a data-toggle="modal" data-target="#myModal" data-backdrop="static"
                                data-keyboard="false" href="" onclick="fetch_account({{@$building->buildingid}})" class="badge delete badge-info">Update</a></td>
                                <td><a href='{{ url("admin/buildings/delete/{$building->buildingid}")}}' class="badge delete badge-info">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include("admin/footer")