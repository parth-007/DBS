@include('client/common')
<div class="page-wrapper">
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="row">Booking id</th>
                    <th scope="row">Resource id</th>
                    <th scope="row">Purpose</th>
                    <th scope="row">Contact Number</th>
                    <th scope="row">Expected Audience</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <th>{{$u->bookingid}}</th>
                    <td>{{$u->email}}</td>
                    <td>{{$u->purpose}}</td>
                    <td>{{$u->expected_audience}}</td>
                    <td>{{$u->resourceid}}</td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@include('client/footer')