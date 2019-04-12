@include('admin/common')
 <!-- INM 09-04-2019  -->
<div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Bookings</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
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
                            <th>Sr. No.</th>
                            <th>Resource</th>
                            <th>purpose</th>
                            <th>Time Slot</th>
                            <th>Booked by</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c=0;?>
                        @foreach($bookings as $booking)
                            <tr>
                                <td><?php echo ++$c;?></td>
                                <td>{{ $booking->resourcename}}</td>
                                <td>{{ $booking->purpose}}</td>
                                <td>
                                    <div>From:<b> {{$booking->starttime}}</b> </div>
                                    <div>To: <b>{{$booking->endtime}}</b> </div>
                                </td>
                                <td>
                                    <div>{{ $booking->username}} ({{ $booking->usertype}})</div>
                                    <div>Email: <b> {{ $booking->useremail}} </b> </div>
                                    <div>Ph. No:<b> {{ $booking->phonenumber}} </b></div>
                                </td>
                                <td>{{ $booking->status}}</td>
                            </tr>
                        @endforeach
                        <tr> 
                        <td colspan="6">{{$bookings->render()}}</td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        @if($errors->any())
            $("#error_msg").fadeOut(3000);
        @endif
    });
</script>
@include('admin/footer')