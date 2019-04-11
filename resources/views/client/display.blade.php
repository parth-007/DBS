@include('client/common')
<div class="page-wrapper">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> My Bookings</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                    <th scope="row">#</th>
                    <th scope="row">Resource</th>
                    <th scope="row">Start</th>
                    <th scope="row">End</th>
                    <th scope="row">Purpose</th>
                    <th scope="row">Audience</th>
                    <th scope="row">Status</th>
                    <th scope="row">Action</th>
                </tr>
            </thead>
            <?php $c=0;?>
            <tbody>
                @foreach($final_data as $u)
                <tr>
                    <td><?php echo ++$c;?></td>
                    <td>{{$u->resourcename}}</td>
                    <td>{{$u->starttime}}</td>
                    <td>{{$u->endtime}}</td>
                    <td>{{$u->purpose}}</td>
                    <td>{{$u->expected_audience}}</td>
                    <td>{{$u->status}}</td>    
                    <td>Cancel</td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@include('client/footer')