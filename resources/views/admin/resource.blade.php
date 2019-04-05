@include("admin/common")
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link href="{{asset('client/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        
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
                                        <button type="submit" class="btn btn-info">Add building</button>
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
                                
                                <td><a href='{{ url("admin/resourses/update/{$res->resource_id}")}}' class="badge badge-info">Update</a></td>
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