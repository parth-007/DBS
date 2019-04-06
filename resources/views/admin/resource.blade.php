@include("admin/common")
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script>
        function updateHandler(update_id){
            console.log('clicked '+update_id);

            $.ajax({
                url:"{{url('admin/resources/fetchForUpdate/')}}"+'/'+update_id,
                type:"get",
                success:function(data)
                {
                    // echo data;
                    // $("#btnsubmit").html('Update');
                    var ob=JSON.parse(data);
                    console.log(ob['tblresource']);
                    console.log(ob['tblfacility']);
                    console.log(ob['tblbuilding']);
                    
                    // // fill buildingName
                    $('#updt_buildingname').val(ob['tblresource'][0]['buildingid']).change();

                    //fill facilities
                    if(ob['tblfacility'][0]['ac'] == 1)
                        $('#updt_ac').attr("checked",true);
                    else
                        $('#updt_ac').attr("checked",false);
                    if(ob['tblfacility'][0]['computer'] == 1)
                        $('#updt_computer').attr("checked",true);
                    else
                        $('#updt_computer').attr("checked",false);
                    if(ob['tblfacility'][0]['podium'] == 1)
                        $('#updt_podium').attr("checked",true);
                    else
                        $('#updt_podium').attr("checked",false);
                    if(ob['tblfacility'][0]['mike'] == 1)
                        $('#updt_mic').attr("checked",true);
                    else
                        $('#updt_mic').attr("checked",false);
                    if(ob['tblfacility'][0]['projector'] == 1)
                        $('#updt_projector').attr("checked",true);
                    else
                        $('#updt_projector').attr("checked",false);

                    //fill Resource name
                    $("#updt_resourcename").val(ob['tblresource'][0]['resourcename']);

                    //fill Capacity        
                    $("#updt_capacity").val(ob['tblresource'][0]['capacity']);

                    //set hiddenField for resourceId
                    $('#updt_id').val(ob['tblresource'][0]['resource_id']);
                    
                    //set hiddenField for FacilityId
                    $('#facility_id').val(ob['tblfacility'][0]['facilityid']);
                     
                }
            });

        }
        </script>
        
    </head>
<body>
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Resource</h3> 
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Resource</li>
                    </ol>
                </div>
            </div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            
            <!-- <button type="button" class="btn btn-info">Add building</button> -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-whatever="@mdo">Add resource</button>
                        <!-- Insert model -->
                        <div class="container">
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Add Resource</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <form action='{{url("admin/resources/insert")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <!-- Building dropdown -->
                                                <label for="buildingName">Select Building :</label>
                                                
                                                <select class="form-control custom-select" name="buildingname" id="buildingname">
                                                    @foreach($buildings as $build)
                                                    <option value="{{$build->buildingid}}">{{$build->buildingname}}</option>
                                                    @endforeach
                                                </select>
                                                <hr>
                                                <!-- Facility Selection -->
                                                <div class="FacilityContainer">
                                                    Select Facilities :
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="ac" id="">
                                                        <label for="ac">Ac</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="computers" id="">
                                                        <label for="computers">Computer</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="podium" id="">
                                                        <label for="podium">Podium</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="mic" id="">
                                                        <label for="mic">Mic</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="projector" id="">
                                                        <label for="projector">Projector    </label>
                                                </div>
                                                <hr>
                                                <div>
                                                    <label for="resourcename">Resorce Name :</label>
                                                    <input type="text" class="form-control" name="resourcename">
                                                </div>
                                                <div>
                                                    <label for="capacity">Capacity :</label>
                                                    <input type="number" class="form-control" name="capacity">
                                                </div>

                                            </div>
                                            
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info">Add Resource</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- Update modal -->
                        <div class="container">
                            <div class="modal" id="updateModal">
                                <div class="modal-dialog">
                                <div class="modal-content">
                
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Update Resource</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <form action='{{url("admin/resources/update/")}}' method="post">
                                {{csrf_field()}}
                                    <div class="modal-body">
                                            <div class="form-group">
                                                <!-- Building dropdown -->
                                                <label for="buildingName">Select Building :</label>
                                                
                                                <select class="form-control custom-select" name="updt_buildingname" id="updt_buildingname">
                                                    @foreach($buildings as $build)
                                                    <option value="{{$build->buildingid}}">{{$build->buildingname}}</option>
                                                    @endforeach
                                                </select>
                                                <hr>
                                                <!-- Facility Selection -->
                                                <div class="FacilityContainer">
                                                    Select Facilities :
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="updt_ac" id="updt_ac">
                                                        <label for="ac">Ac</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="updt_computers" id="updt_computers">
                                                        <label for="computers">Computer</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="updt_podium" id="updt_podium">
                                                        <label for="podium">Podium</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="updt_mic" id="updt_mic">
                                                        <label for="mic">Mic</label>
                                                    <br>
                                                    
                                                        <input type="checkbox" class="checkbox" name="updt_projector" id="updt_projector">
                                                        <label for="projector">Projector    </label>
                                                </div>
                                                <hr>
                                                <div>
                                                    <label for="resourcename">Resorce Name :</label>
                                                    <input type="text" class="form-control" name="updt_resourcename" id="updt_resourcename">
                                                </div>
                                                <div>
                                                    <label for="capacity">Capacity :</label>
                                                    <input type="number" class="form-control" name="updt_capacity" id="updt_capacity">
                                                </div>
                                                    <input type="hidden" name="updt_id" id="updt_id" value="">
                                                    <input type="hidden" name="facility_id" id="facility_id" value="">
                                            </div>
                                            
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info">Update Resource</button>
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
                            <th>Resource-id</th>
                            <th>Resource-name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($resource as $res)
                            <tr>
                                <td>{{ $res->resource_id}}</td>
                                <td>{{ $res->resourcename}}</td>
                                
                                <td><a href="" onclick="updateHandler({{$res->resource_id}})" data-toggle="modal" data-target="#updateModal" class="badge badge-info">Update</a></td>
                                <!-- <button type="button" class="btn btn-info" data-toggle="modal"  data-whatever="@mdo">Add resource</button> -->
                                <td><a href='{{ url("admin/resourses/delete/{$res->resource_id}")}}' class="badge badge-info">Delete</a></td>
                            </tr>   
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            {{$resource->links()}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


    </body>
    </html>
@include("admin/footer")