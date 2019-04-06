@include('client/common')
<div class="page-wrapper">
    <div class="container-fluid" >
        <div class="card">
            <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="row">No</th>
                    <th scope="row">Name</th>
                    <th scope="row">Purpose</th>
                    <th scope="row">Contact Number</th>
                    <th scope="row">Expected Audience</th>
                    <th scope="row">Accept/Denied</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>abc</td>
                    <td>abc</td>
                    <td>abc</td>
                    <td>abc</td>
                    <td>
                        <a href="#"><button class="btn btn-success"><span class="fa fa-check"></span></button></a>
                        <a href="#"><button class="btn btn-danger"><span class="fa fa-times"></span></button></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>abc</td>
                    <td>abc</td>
                    <td>abc</td>
                    <td>abc</td>
                    <td>
                        <a href="#"><button class="btn btn-success"><span class="fa fa-check"></span></button></a>
                        <a href="#"><button class="btn btn-danger"><span class="fa fa-times"></span></button></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@include('client/footer')