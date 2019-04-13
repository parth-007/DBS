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
                    <center>
                    <div id="succ_msg" style="position: fixed;top: 30px; left: 20%; right: 20%; z-index: 999999;padding:10px 5px;background: blue;color:white;display: none;">
                        <div class="">
                        <strong>Done!</strong> Replay Was sended
                        </div>
                    </div>
                    </center>  
            <div class="table-responsive m-t-40">

            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Inquiry</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inquiry as $inq)
                            <tr>
                                <td>{{ $inq->email}}</td>
                                <td style="word-break: break-word;">{{ $inq->message}}</td>
                                <td><a data-toggle="modal" data-target="#myModal_replay"><button id="{{$inq->id}}" class="btn btn-success btn_req_response"><span class="fa fa-reply"></span></button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                <div>{{$inquiry->links()}}</div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal" id="myModal_replay">
    <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header">
    <h4 class="modal-title">Replay</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    
    <form id="frm_replay" method="post">
    {{csrf_field()}}
        <div class="modal-body">

                <label for="building" class="col-form-label">Replay message:</label>
                <div class="form-group">
                    <textarea rows="4" cols="60" name="txt_message" id="txt_message" style="resize: none;" required></textarea>
                </div>
        </div>
        <input type="hidden" name="aid" id="aid">
        <div class="modal-footer">
            <button type="button" id="btn_close" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Replay</button>
        </div>
    </form>
</div>
</div>
</div>
<!-- end -->
<script type="text/javascript">
    $(document).ready(function(){
        @if($errors->any())
            $("#error_msg").fadeOut(4000);
        @endif
        var id;
        $(document).on("click",".btn_req_response",function(){
            id=$(this).attr("id");
        });
        $("#frm_replay").validate({

        });
        $("#frm_replay").submit(function(e){
            e.preventDefault();
            if($("#frm_replay").valid())
            {
                $.ajax({
                    url: '{{url("replaytoinquiry")}}',
                    type: 'POST',
                    dataType:"JSON",
                    data: {'txt_message': $("#txt_message").val(),"id":id,"_token":"{{csrf_token()}}"}
                })
                .done(function(response) {
                    if(response==1 || response=="1")
                    {
                        $("#txt_message").val("");
                        $("#btn_close").trigger('click');
                        $("#succ_msg").fadeIn();
                        $("#succ_msg").fadeOut(4000);
                        $("#"+id).parent().parent().parent().remove();
                    }
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
    });
</script>
@include('admin/footer')