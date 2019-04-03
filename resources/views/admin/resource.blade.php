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
                    <h3 class="text-primary">Resource</h3> </div>
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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Resource</button>
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
                                <!-- <td>
                                    <div class="sweetalert m-t-15">
                                        <button class="btn btn-success btn sweet-prompt">Update</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="sweetalert m-t-15">
                                            <button class="btn btn-danger btn sweet-confirm">Delete</button>
                                    </div>
                                </td> -->
                                <!-- <td></td> -->
                                <td><a href='{{ url("admin/resource/update/{$res->resource_id}")}}' class="badge badge-info">Update</a></td>
                                <td><a href='{{ url("admin/resource/delete/{$res->resource_id}")}}' class="badge badge-info">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



    </body>
    </html>
@include("admin/footer")