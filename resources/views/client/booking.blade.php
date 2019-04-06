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
                            console.log(data);
                       }
            });
        });
    });
</script>
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
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
                                                    <input class="form-control" id="cdate" name="mybd" value="" placeholder="YYYY/MM/DD" type="text" style="background: inherit;" readonly>
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
                                    <input type="text" id="from" name="from" class="form-control" placeholder="From" style="background: inherit;" readonly>
                                        </div>
                                    </div>

                                     <div class="col-sm-2">
                                             <div class="form-group input-group clockpicker">
                                    <input type="text" id="to" name="to" class="form-control" placeholder="To" style="background: inherit;" readonly>
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
                <script src="{{asset('client/js/bootstrap-datepicker.min.js')}}"></script>
    
                <script type="text/javascript" src="{{asset('client/js/multiple-select.js')}}"></script>
            <script type="text/javascript">
              

                $(document).ready(function(){

                    var date_input=$('input[name="mybd"]'); //our date input has the name "date"
                    var container=$('.bootstrap-iso .form').length>0 ? $('.bootstrap-iso .form').parent() : "body";
                    date_input.datepicker({
                        format: 'yyyy/mm/dd',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    })
                })
            </script>
@include('client/footer')