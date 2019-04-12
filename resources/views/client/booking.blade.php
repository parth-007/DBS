@include('client/common')
<link rel="stylesheet" type="text/css" href="{{asset('client/css/multiple-select.css')}}">
<link rel="stylesheet" href="{{asset('client/css/bootstrap-datepicker3.css')}}"/>
<link rel="stylesheet" href="{{asset('client/css/clockpicker.css')}}"/>
<link rel="stylesheet" href="{{asset('client/css/standalone.css')}}"/>

<script type="text/javascript" src="{{asset('client/js/clockpicker.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
 $('.clockpicker').clockpicker();
}
</script>
<script type="text/javascript">
    function main_task(id,status="",date="",from="",to=""){
        $('#mainid').val(id);
        // alert(status);
        if(status=='')
        {
            $('#i1').text("Book Now");
            $('#sta1').val('Book');
        }
        else{
            $('#i1').text("Request");
            $('#sta1').val('Request');
        }
        
        $('#stt').val(date+' '+from+":00");
        $('#ett').val(date+' '+to+":00");

        $('#from1').text(date+' '+from);
        $('#to1').text(to);

    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myform1').submit(function(e){
            e.preventDefault();

            var formData = new FormData($(this)[0]);  
            var cdate = $('#cdate').val();
            var res = $('#b1').val();
            var from = $('#from').val();
            var to = $('#to').val();

            $.ajax({
                type:"post",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{url('client/show_slots')}}",
                data:formData,
                 async: false,   
                       cache: false,
                       contentType: false,
                       enctype: 'multipart/form-data',
                       processData: false,

                       success:function(data)
                       {
                            $('#myresult').html(data);
                       }
            });
        });
    });
</script>

<style>
    .card-tbl1 th{
        vertical-align: top;
    }
    input[type=checkbox]:disabled{
        background:white;
    }
</style>

<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="padding: 0 auto;">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
               
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
               
              
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
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
                                <h4 class="card-title">Booking</h4>
                            <form class="m-t-40" method="post" enctype="multipart/form-data" id="myform1"> 
                              {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-sm-3 text-right">Date</div>
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                     <i class="fa fa-calendar">
                                                     </i>
                                                    </div>
                                                    <input class="form-control" id="cdate" name="mybd" value="" placeholder="YYYY/MM/DD" type="text" style="background: inherit;" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                             <div class="col-sm-3 text-right">Select Building</div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <select class="form-control" name="building" id="b1">
                                                        <option value="">Please Select</option>
                                                            @foreach($building as $b)
                                                                <option value="{{$b->buildingid}}">{{$b->buildingname}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                     <div class="col-sm-3 text-right">Select Time</div>
                                        <div class="col-sm-2">
                                             <div class="form-group input-group clockpicker">
                                    <input type="text" id="from" name="from" class="form-control" placeholder="From" style="background: inherit;" required readonly>
                                        </div>
                                    </div>

                                     <div class="col-sm-2">
                                             <div class="form-group input-group clockpicker">
                                    <input type="text" id="to" name="to" class="form-control" placeholder="To" style="background: inherit;" required readonly>
                                        </div>
                                    </div>
                                </div>
                                       



<script type="text/javascript">
                        $('.clockpicker').clockpicker();
                    </script> 
            

                                        <div class="row">
                                            <div class="col-sm-3 text-right"></div>
                                            <div class="col-sm-5">
                                                <button class="btn btn-primary" type="submit" name="submit">Check</button>
                                            </div>
                                        </div>      

                                

                            </form>    
                            </div>
                        </div>
                    </div>
                    

                    



                     
                </div>
              


            </div>
            <div class="container-fluid" style="padding: 0 auto;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="myresult">

                                    


                                   
                                    
                                    
                    
                    
                                </div>
                            </div>
                        </div>    
                    </div>
                    
                </div>
            </div>

            <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="{{url('client/add_slot')}}">
        {{csrf_field()}}
        <div class="modal-body">
        <input type="hidden" id="mainid" name="mainid">
        <input type="hidden" id="sta1" name="sta1">
          <label>Time: <span id="from1" style="margin-left:20px"></span> To <span id="to1"></span> </label><input type="hidden" value="" name="stt" id="stt"><input type="hidden" value="" name="ett" id="ett">
          <br>
          <label>Purpose:</label><input type="text" name="purpose" placeholder="Purpose" style="margin-left:17px;">
          <br>
          <label>Audience:</label><input type="text" name="audi" placeholder="Expected Audience" style="margin-left:10px;">
        </div>
        <div class="modal-footer">
        
        <button type="submit" class="btn btn-default" id="i1" name="mybtn"></button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>

        </div>
      </div>
      
    </div>
  </div>
                <script src="{{asset('client/js/bootstrap-datepicker.min.js')}}"></script>
    
                <script type="text/javascript" src="{{asset('client/js/multiple-select.js')}}"></script>
            <script type="text/javascript">
              

                $(document).ready(function(){

                    var date_input=$('input[name="mybd"]'); //our date input has the name "date"
                    var container=$('.bootstrap-iso .form').length>0 ? $('.bootstrap-iso .form').parent() : "body";
                    date_input.datepicker({
                        format: 'yyyy-mm-dd',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    })
                })
            </script>
            <script type="text/javascript">
                $(document).ready(function(){
                    @if($errors->any())
                        $("#error_msg").fadeOut(3000);
                    @endif
                });
            </script>
@include('client/footer')