@include('admin/common')
        <script>
            $(document).ready(function(){
                $(document).on("click","#today_bookings",function(){
                    if($("#bookings_count_today").text()=='0' || $("#bookings_count_today").text()==0)
                    {
                        alert("No booking today");
                    }
                    else
                        window.open('{{url('admin/bookings_print_todays')}}','_blank');
                });
            });
        </script>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                 <!-- {{session('admin_email')}} -->
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>

            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                <div class="col-md-4">
                        <a href="#" id="today_bookings">
                            <div class="card p-30" >
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-calendar-check-o f-s-40 color-danger"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h2 id="bookings_count_today">{{$bookings_count_today}}</h2>
                                        <p class="m-b-0">Today's bookings</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{url('admin/resources')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-building f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$resources_count}}</h2>
                                    <p class="m-b-0">Resources</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!--  -->
                    
                    <div class="col-md-4">
                        <a href="{{url('admin/bookings')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-calendar f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$bookings_count}}</h2>
                                    <p class="m-b-0">Total bookings</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4">
                    <a href="{{url('admin/users')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$users_count}}</h2>
                                    <p class="m-b-0">Users</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-4" >
                    <a href="{{url('admin/buildings')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-institution f-s-40 color-info"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$buildings_count}}</h2>
                                    <p class="m-b-0">Total buildings</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4" >
                    <a href="{{url('admin/Clubs_Committees')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-users f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$users_cc}}</h2>
                                    <p class="m-b-0">Total clubs/committes</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4" >
                    <a href="{{url('admin/faculty')}}" >
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>{{$faculty_count}}</h2>
                                    <p class="m-b-0">Total faculties</p>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="row bg-white m-l-0 m-r-0 box-shadow ">
                </div>
            <!-- End Container fluid  -->
        </div>
@include('admin/footer')