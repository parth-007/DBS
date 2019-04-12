@include('client/common')
<style type="text/css">
    th{
        /*text-align: center;*/
    }
    td{
        /*text-align: center;*/
        border:0px solid transparent;
    }
    table.inner-tb *{
        border:0px solid transparent;
    }
    h5{
        text-align: center;
    }
</style>
<script type="text/javascript">
    function AcceptModal($rid,$uid)
    {
        console.log($rid , $uid);
        $("#DModal").modal('hide');
        $("#AModal").modal();
        $("#hid_val_rid").val($rid);
        $("#hid_val_uid").val($uid);
        // var hid1 = $("#hid_val_rid").val();
        // var hid2 = $("#hid_val_uid").val();
        // console.log(hid1 , hid2);
    }
    function DeniedModal($rid,$uid)
    {
      console.log($rid , $uid);
        $("#AModal").modal('hide');
        $("#DModal").modal();
        $("#hid_val_rid").val($rid);
        $("#hid_val_uid").val($uid);
        // var hid1 = $("#hid_val_rid").val();
        // var hid2 = $("#hid_val_uid").val();
        // console.log(hid1 , hid2);
    
    }
    function Confirm_Req()
    {
        var hid1 = $("#hid_val_rid").val();
        var hid2 = $("#hid_val_uid").val();
        window.location = "/Respond_Request/"+hid1+"/"+hid2;
    }
    function Denied_Req()
    {
        var id = $("#hid_val").val();
        console.log(id);    
    }
    $(document).ready(function(){
        
    });
</script>
<div class="page-wrapper">
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Request</h4>
            <?php
        if ($request_data->count()>0) {
                    $c=0;
            ?>   
        <table class="table table-hover">
            <!-- <thead>
                 
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">User</th>
                    <th scope="row">Purpose</th>
                    <th scope="row">Expected Audience</th>
                    <th scope="row">Resource</th>
                    <th scope="row">Contact</th>
                    <th scope="row">Start Time</th>
                    <th scope="row">End Time</th>
                    <th scope="row">Accept/Denied</th>
                </tr>
            </thead> -->
            <thead>
                <tr>
                    <th scope="row">#</th>
                    <th scope="row">Requested User's Booking</th>
                    <th scope="row">Your Booking</th>
                    <th scope="row">Accept/Denied</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($request_data as $u)
                <tr>
                    <th scope="row" style="vertical-align: middle;">{{++$c}}</th>
                    <td>
                    <table class="inner-tb">
                    <tr>
                        <th>UserName :</th>
                        <td>{{$u->username}}</td>
                    </tr>
                    <tr>
                        <th>Contact :</th>
                        <td>{{$u->phonenumber}}</td>
                    </tr>
                    <tr>
                        <th>Purpose: </th>
                        <td>{{$u->purpose}}</td>
                    </tr>
                    <tr>
                        <th>Expected Audience :</th>
                        <td>{{$u->expected_audience}}</td>
                    </tr>
                    <tr>
                        <th>Resource Name :</th>
                        <td>{{$u->resourcename}}</td>
                    </tr>
                    <tr>
                        <th>Start Time :</th>
                        <td>{{$u->starttime}}</td>
                    </tr>
                    <tr>
                        <th>End Time :</th>
                        <td>{{$u->endtime}}</td>
                    </tr>
                    </table >
                    </td>
                    <td>
                    <table class="inner-tb">
                    <tr><td>- </td></tr>
                    <tr><td>- </td></tr>
                    <tr>
                        <th>Purpose: </th>
                        <td>{{$u->b1_purpose}}</td>
                    </tr>
                    <tr>
                        <th>Expected Audience :</th>
                        <td>{{$u->b1_expected_audience}}</td>
                    </tr>
                    <tr>
                        <th>Resource Name :</th>
                        <td>{{$u->resourcename}}</td>
                    </tr>
                    <tr>
                        <th>Start Time :</th>
                        <td>{{$u->b1_starttime}}</td>
                    </tr>
                    <tr>
                        <th>End Time :</th>
                        <td>{{$u->b1_endtime}}</td>
                    </tr>
                    </table>
                </td>
                
                    <td style="vertical-align: middle;">
                        <button id="accept_button" class="btn btn-success" onclick="AcceptModal(<?php echo $u->bookingid ?>,<?php echo $u->b1_bookingid ?>)"><span class="fa fa-check"></span></button>
                        <button id="denied_button"  class="btn btn-danger" onclick="DeniedModal(<?php echo $u->bookingid ?>,<?php echo $u->b1_bookingid ?>)"><span class="fa fa-times"></span></button>
                    </td>
                </tr>

               
                @endforeach
            </tbody>
        </table>
        <div class="container" style="color: black;">
                  <div class="modal fade" id="AModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="color: black;">Respond To Requests</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body" style="color: black;">
                          <p>You are about to Accept request</p>
                            <p>Do you want to proceed?</p>
                            <input type="hidden" id="hid_val_rid">
                            <input type="hidden" id="hid_val_uid">
                        </div>
                        <div class="modal-footer">
                            <a id="btnYes" class="btn btn-danger" onclick="Confirm_Req();">Yes</a>
                            <a data-dismiss="modal" aria-hidden="true" class="btn btn-success">NO</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="container">
                  <div class="modal fade" id="DModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="color: black;">Respond To Requests</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          
                        </div>
                        <div class="modal-body" style="color: black;">
                           <p>You are about to cancel request</p>
                            <p>Do you want to proceed?</p>
                            <input type="hidden" id="hid_val_rid">
                            <input type="hidden" id="hid_val_uid">
                        </div>
                        <div class="modal-footer">
                            <a id="btnYes" class="btn btn-danger" onclick="Denied_Req();">Yes</a>
                            <a data-dismiss="modal" aria-hidden="true" class="btn btn-success">NO</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
        <?php
        }
        else
        {
            echo "<h5>No Record Found</h5>";
        } 
        ?>
    </div>
</div>
    </div>
</div>
@include('client/footer')