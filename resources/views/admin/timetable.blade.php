@include('admin/common')
<script>
function checkme()
{
    if(document.getElementById("prg").selectedIndex==1)
    {
        var t1=document.getElementById("c1");
        t1.innerHTML="";
        
            /*document.getElementById("c1").options[i]=new Option("Surat");
            document.getElementById("c1").options[i]=new Option("Vadodara");*/
            
            var option=document.createElement("Option");
            option.text="2";
            option.value="2";
            c1.add(option);
            
            var option1=document.createElement("Option");
            option1.text="4";
            option1.value="4";
            c1.add(option1);

            var option2=document.createElement("Option");
            option2.text="6";
            option2.value="6";
            c1.add(option2);

        //alert("54");
    }
    else if(document.getElementById("prg").selectedIndex==2)
    {
            var t1=document.getElementById("c1");
        t1.innerHTML="";
        var option=document.createElement("Option");
            option.text="2";
            option.value="2";
            c1.add(option);
            
         
    //  alert("2");
    }
}
</script>
<script>
    $(document).ready(function($) {
        $("#frm_timetable").validate({

        });   
        function checktime(start,end){
            return end>start;
        }
        function checkdate(dt){
            return dt>=new Date();
        }
        $("#frm_timetable").submit(function(e){
            e.preventDefault();
            if($("#frm_timetable").valid())
            {
                if(checkdata($("#")))
                if(!checktime($("#time_start").val(),$("#time_end").val()))
                {
                    $("#lbl_timerr").show();
                    return;
                }
                $("#lbl_timerr").hide();
                $.ajax({
                    url: '/path/to/file',
                    type: 'default GET (Other values: POST)',
                    dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                    data: {param1: 'value1'},
                })
                .done(function(res) {
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
<div class="page-wrapper">
        
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Add Timetable Slot</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Timetable Slot</li>
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                            
                        <!-- <button type="button" class="btn btn-info">Add building</button> -->
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Add Slot</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="frm_timetable" method="post">
                                        <div class="form-group">
                                            <label>Select Programme</label>
                                            <select name="programme" id="prg" class="form-control" onchange="checkme()" required="">
                                                <option value="">Select</option>
                                                @foreach($prog_data as $p){
                                                <option value="{{$p->programmeid}}">{{$p->programmename}}</option>
                                                @endforeach
                                            }
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>Select Semester</label>
                                            <select name="semester" id="c1" class="form-control" required="">
                                                <option value="">Select</option>
                                            }
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>Select Day</label>
                                            <select name="day" id="d1" class="form-control" required="">
                                                <option value="">Select</option>
                                                <option value="monday">Monday</option>
                                                <option value="tuesday">Tuesday</option>
                                                <option value="wednesday">Wednesday</option>
                                                <option value="thursday">Thursday</option>
                                                <option value="friday">Friday</option>
                                                <option value="saturday">Saturday</option>
                                                <option value="Sundayday">Sunday</option>
                                            }
                                            </select>

                                        </div>


                                        <div class="form-group">
                                            <label>Select Start Time</label>
                                            <input type="time" name="time_start" class="form-control" id="time_start" required="">

                                        </div>


                                        <div class="form-group">
                                            <label>Select End Time</label>
                                            <input type="time" name="time_end" class="form-control" id="time_end" required="">
                                            <label id="lbl_timerr" style="color:red;display: none" for="">Must greater than start Time</label>

                                        </div>


                                        <div class="form-group">
                                            <label>Select Faculty</label>
                                           <select id="fac" name="faculty" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($fac_data as $f){
                                            <option value="{{$f->email}}">{{$f->username}}
                                            </option>
                                            }
                                        @endforeach
                                    </select>
                                        </div>

                                         <div class="form-group">
                                            <label>Course ID</label>
                                            <input name="courseid" id="cid" class="form-control" required="">
                                                
                                            
                                            

                                        </div>



                                         <div class="form-group">
                                            <label>Select Resource</label>
                                           <select id="resource" name="resource" class="form-control" required="">
                                            <option value="">Select</option>
                                            @foreach($res_data as $r){
                                            <option value="{{$r->resource_id}}">{{$r->resourcename}}
                                            </option>
                                            }
                                        @endforeach
                                    </select>
                                        </div>




                                        
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                       
                    </div>
                </div>
                 
           
        </div>
                @include('admin/footer')