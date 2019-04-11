<!-- // INM 10-04-2019 -->
<link href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>

<script>
    $(document).ready(function(){
            window.print();  
    });
</script>
<div class="table-responsive m-t-40">
                <center>
                    <h3>Booking slots for {{$todayDate}}</h3>
                </center>
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Resource</th>
                            <th>purpose</th>
                            <th>Time Slot</th>
                            <th>Booked by</th>
                            <th>Signature</th>
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
                                    <div>To:<b> {{$booking->endtime}}</b> </div>
                                </td>
                                <td>
                                    <div>{{ $booking->username}} ({{ $booking->usertype}})</div>
                                    <div>Email: <b> {{ $booking->useremail}} </b> </div>
                                    <div>Ph. No:<b> {{ $booking->phonenumber}} </b></div>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
