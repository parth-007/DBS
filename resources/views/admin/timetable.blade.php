@include('admin/common')
<script>
function checkme()
{   
    if(document.getElementById("prg").selectedIndex==1)
    {
        if((document.getElementById("rdbtnWinter").checked))
        {
        
            var t1=document.getElementById("c1");
            t1.innerHTML="";
            
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

            var option=document.createElement("Option");
            option.text="8";
            option.value="8";
            c1.add(option);
        }
        else if(document.getElementById("rdbtnAutumn").checked)
        {
            var t1=document.getElementById("c1");
            t1.innerHTML="";

            var option=document.createElement("Option");
            option.text="1";
            option.value="1";
            c1.add(option);
            
            var option=document.createElement("Option");
            option.text="3";
            option.value="3";
            c1.add(option);

            var option=document.createElement("Option");
            option.text="5";
            option.value="5";
            c1.add(option);

            var option=document.createElement("Option");
            option.text="7";
            option.value="7";
            c1.add(option);
        }
    }
    else if(document.getElementById("prg").selectedIndex==2 || document.getElementById("prg").selectedIndex==3 )
    {
            if(document.getElementById("rdbtnWinter").checked)
            {
                var t1=document.getElementById("c1");
                t1.innerHTML="";

                var option=document.createElement("Option");
                option.text="2";
                option.value="2";
                c1.add(option);

                var option=document.createElement("Option");
                option.text="4";
                option.value="4";
                c1.add(option);
            }
            else if(document.getElementById("rdbtnAutumn").checked)
            {
                var t1=document.getElementById("c1");
                t1.innerHTML="";

                var option=document.createElement("Option");
                option.text="1";
                option.value="1";
                c1.add(option);

                var option=document.createElement("Option");
                option.text="3";
                option.value="3";
                c1.add(option);
            }
    }
}
</script>
<script>
    $(document).ready(function($) {
        $("#frm_timetable").validate({

        });   
        function checktime(start,end){
            return end>=start;
        }
        $("#frm_timetable").submit(function(e){
            e.preventDefault();
            if($("#frm_timetable").valid())
            {
                if(!checktime($("#time_start").val(),$("#time_end").val()))
                {
                    $("#lbl_timerr").show();
                    return;
                }
                $("#lbl_timerr").hide();
                $.ajax({
                    url: "{{url('admin/inserttimetableslot')}}",
                    type: 'POST',
                    data: $("#frm_timetable").serialize()+"&_token={{csrf_token()}}",
                })
                .done(function(res) {
                    if(res==1 || res=="1")
                    {
                        $("#frm_timetable").trigger("reset");
                        //make your success popup
                    }   

                })
                .fail(function(res) {

                })
                .always(function() {

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
                        <!-- <button type="button" class="btn btn-info">Add building</button> -->
                        <div class="col-lg-12">
                           
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="frm_timetable" method="post">

                                        <div class="form-group">
                                            <label>Select Semester Type:</label><br/>
                                            <input type="radio" name="Semester_Type" id="rdbtnAutumn" onchange="checkme()" value="Autumn">Autumn
                                            <input type="radio" name="Semester_Type" id="rdbtnWinter"  onchange="checkme()" value="Winter">Winter
                                        </div>

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
                                            @foreach($fac_data as $f)
                                            {
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
                                            @foreach($res_data as $r)
                                            {
                                            <option value="{{$r->resource_id}}">{{$r->resourcename}}
                                            </option>
                                            }
                                        @endforeach
                                    </select>
                                        </div>
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </div>
                        
                    </div>
                       
        </div>
@include('admin/footer')