@include("admin/common")
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script>
        $(document).ready(function(){

            $(document).on("keyup","#txtSearch",function(){
                var str=$(this).val();
                $.ajax({
                    url: '{{url('admin/resources/searchOnResources')}}',
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
                        $(".resourceData").html("No data matches your search...");
                    }
                    else
                    {
                        $(".resourceData").html(response["responseText"]);
                    }
                    console.log("complete");
                });
            });
        });
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
                    if(ob['tblfacility'][0]['mic'] == 1)
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

                    //set isAllocate Radio Button
                    if(ob['tblresource'][0]['isAllocate'] == 1){
                        console.log(ob['tblresource'][0]['isAllocate']);
                        $('#Yes_isAllocate').prop('checked', true);
                    }
                    else{
                        console.log(ob['tblresource'][0]['isAllocate']);
                        $('#No_isAllocate').prop('checked', true);
                    }
                        
                    
                    
                    
                    
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
                    <div class="col-mid-12 col-lg-12">
                        <button type="button" class="btn btn-info col-md-3 col-lg-3" data-toggle="modal" data-target="#myModal" data-whatever="@mdo" style="display: inline-block">Add resource</button>
                        <div class="col-md-5 col-lg-5" style="display:inline-block;min-width:auto"></div>
                        <input type="text" id="txtSearch" class="form-control col-md-3 col-lg-3"  placeholder="Type to search..." style="display: inline;margin-left:auto;">
                    </div>
                    
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

                                                <div>
                                                    <label for="isAllocate">isAllocate :</label>
                                                    <label for="">&nbsp&nbsp<input type="radio" class="" name="isAllocate" id="Yes" value="1">&nbsp Yes </label>
                                                    <label for="">&nbsp&nbsp&nbsp<input type="radio" class="" name="isAllocate" id="No" value="0">&nbsp No</label>
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
                                                <div>
                                                    <label for="isAllocate">isAllocate :</label>
                                                    <label for="">&nbsp&nbsp<input type="radio" class="" name="updt_isAllocate" id="Yes_isAllocate" value="1">&nbsp Yes </label>
                                                    <label for="">&nbsp&nbsp&nbsp<input type="radio" class="" name="updt_isAllocate" id="No_isAllocate" value="0">&nbsp No</label>
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
                            <th>Capacity</th>
                            <th>isAllcate</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody class="resourceData" id="resourceData">
                         @foreach($resource as $res)
                            <tr>
                                <td>{{ $res->resource_id}}</td>
                                <td>{{ $res->resourcename}}</td>
                                <td>{{ $res->capacity}}</td>
                                <td>@if($res->isAllocate == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
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