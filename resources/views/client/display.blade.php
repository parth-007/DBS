@include('client/common')
<style type="text/css">
    th{
        text-align: center;
    }
    td{
        text-align: center;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">My Bookings</h4>
        <table class="table table-hover">
            <?php
            $c=0;
             ?>
            <thead>
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">Resource</th>
                    <th scope="row">Purpose</th>
                    <th scope="row">Contact</th>
                    <th scope="row">Start</th>
                    <th scope="row">End</th>
                    <th scope="row">Booking Status</th>
                    <th scope="row">Cancel Booking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{++$c}}</td>
                    <td>{{$u->resourcename}}</td>
                    <td>{{$u->purpose}}</td>
                    <td>{{$u->phonenumber}}</td>
                    <td>{{$u->starttime}}</td>
                    <td>{{$u->endtime}}</td>
                    <td>{{$u->status}}</td>
                    <td style="text-align: center;">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#myModal_{{$u->bookingid}}"><span class="fa fa-times"></span></button>
                    </td>
                    <td>
                <div id="myModal_{{$u->bookingid}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Delete Booking</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>You are about to delete.</p>
                            <p>Do you want to proceed?</p>
                        </div>
                        <div class="modal-footer">
                                <a href="\client\del_booking\{{$u->bookingid}}" id="btnYes" class="btn btn-danger">Yes</a>
                                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-success">No</a>
                        </div>
                        </div>
                    </div>
                </div>
                    </td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@include('client/footer')