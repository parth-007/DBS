@include('client/common')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                   
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Today's Bookings</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="text-success"></i> {{$tb}}</h2>
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Bookings</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><i class="text-info"></i> {{$tob}}</h2>
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$user_data->username}}</h4>
                                <div class="text-left">
                                    <h4 class="font-light m-b-0"><i class="text-info"></i>
                                        {{$user_data->email}}</h4>
                                    
                                    <h4 class="font-light m-b-0"><i class="text-info"></i>
                                        {{$user_data->phonenumber}}</h4>
                                </div>
                               
                            </div>
                        </div>
                    </div>


                    <!-- Column -->
                    <!-- Column -->
                   
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- Row -->
               
                <!-- Row -->
                <!-- Row -->
           
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
            
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
@include('client/footer')