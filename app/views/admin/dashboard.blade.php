@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

	 {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}
    
@stop

@section('content')

    <!-- Site wrapper -->
    <div class="wrapper">
      
      	<!-- Top Header Starts Here -->
      	@include('admin.layouts.navbar')
		<!-- Top Header Starts Here -->
        
        <!-- Sidebar Starts Here -->
      	@include('admin.layouts.sidebar')
		<!-- Sidebar Starts Here -->
        
        <!-- Content Block Starts Here -->
      	<div class="content-wrapper">
        
        	<!-- Content Header (Page header) -->
        	<section class="content-header">
          
          		<h1>Dashboard</h1>
          
          		<ol class="breadcrumb">
            
            		<li class="active"><i class="fa fa-dashboard"></i>  Home</li>
          		
                </ol>
        		
          	</section>

        	<!-- Main content -->
        	<section class="content">
                
                <!-- Small boxes (Stat box) -->
                    <div class="row">
                                         
                    <div class="col-lg-3 col-xs-6">
              
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                    
                            <div class="inner">
                    
                                <h3>{{ $statistics['users_count'] }}</h3>
                                <p>Admin Registrations</p>
                    
                            </div>
                    
                            <div class="icon">
                    
                                <i class="ion ion-person-add"></i>
                    
                            </div>
                    
                            <a href="{{ URL::route('admin_users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-red">

                            <div class="inner">

                                <h3>{{ $statistics['ins_count'] }}</h3>
                                <p>Institutions Registrations</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person-add"></i>

                            </div>

                            <a href="{{ URL::route('admin_institutions_users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-green">

                            <div class="inner">

                                <h3>{{ $statistics['brands_count'] }}</h3>
                                <p>Brands Registrations</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person-add"></i>

                            </div>

                            <a href="{{ URL::route('admin_brands_users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-aqua">

                            <div class="inner">

                                <h3>{{ $statistics['students'] }}</h3>
                                <p>Student Registrations</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person-add"></i>

                            </div>

                            <a href="{{ URL::route('admin_students_users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <!-- ./col -->
                                                                
                </div>
                <!-- /.row --> 
                <div class="row">

                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-red">

                            <div class="inner">

                                <h3>{{ $statistics['all_press_count'] }}</h3>
                                <p>Total Press News</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person-add"></i>

                            </div>

                            <a href="{{ URL::route('admin_sliders_press') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-yellow">

                            <div class="inner">

                                <h3>{{ $statistics['active_offers_count'] .'/'.$statistics['offers_count']}}</h3>
                                <p>Offers (Active / All)</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-ios-pricetags-outline"></i>

                            </div>

                            <a href="{{ URL::route('admin_offers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-maroon">

                            <div class="inner">

                                <h3>{{ $statistics['active_internships_count'].'/'.$statistics['inactive_internships_count'] }}</h3>
                                <p>Internships (Active / Inactive)</p>

                            </div>

                            <div class="icon">
                                <i class="ion ion-ios-paper-outline"></i>
                            </div>

                            <a href="{{ URL::route('admin_internships') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-green">

                            <div class="inner">

                                <h3>{{ $statistics['events_count'] }}</h3>
                                <p>Brand Events</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-ios-calendar-outline"></i>

                            </div>

                            <a href="{{ URL::route('admin_events') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>

                    
                    <!-- ./col -->

                </div>


                <div class="row">


                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-light-blue">

                            <div class="inner">

                                <h3>{{$statistics['photos_count'] }}</h3>
                                <p>Brand Photos</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-ios-camera-outline"></i>

                            </div>

                            <a href="{{ URL::route('admin_photos') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                     <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-aqua">

                            <div class="inner">

                                <h3>{{ $statistics['texts_count']}}</h3>
                                <p>Brand Text</p> 
                            </div> 
                            <div class="icon">
                                <i class="ion ion-ios-paper-outline"></i>
                            </div> 
                            <a href="{{ URL::route('admin_links') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                        </div> 
                    </div>
                     <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-green">

                            <div class="inner">

                                <h3>{{ $statistics['insevents_count'] }}</h3>
                                <p>Institution Events</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-ios-calendar-outline"></i>

                            </div>

                            <a href="{{ URL::route('admin_inst_events') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                     <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-light-blue">

                            <div class="inner">

                                <h3>{{$statistics['insphotos_count'] }}</h3>
                                <p>Institution Photos</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-ios-camera-outline"></i>

                            </div>

                            <a href="{{ URL::route('admin_inst_photos') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                     <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-green">

                            <div class="inner">

                                <h3>{{ $statistics['instexts_count']}}</h3>
                                <p>Institution Text</p> 
                            </div> 
                            <div class="icon">
                                <i class="ion ion-ios-paper-outline"></i>
                            </div> 
                            <a href="{{ URL::route('admin_inst_links') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> 
                        </div> 
                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-red">

                            <div class="inner">

                                <h3>{{ $statistics['internship_application_count'] }}</h3>
                                <p>Internship Applications</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-person"></i>

                            </div>

                            <a href="{{ URL::route('internship_applications') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-maroon">

                            <div class="inner">

                                <h3>{{ $statistics['unread_enquiry_count'] .'/'.$statistics['enquiry_count'] }}</h3>
                                <p>Enquiries (Unread/All)</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-at"></i>

                            </div>

                            <a href="{{ URL::route('admin_enquiries') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-6">

                        <!-- small box -->
                        <div class="small-box bg-purple">

                            <div class="inner">

                                <h3>{{ $statistics['unread_problems_count'].'/'.$statistics['problems_count'] }}</h3>
                                <p>Report Problem (Unread/All)</p>

                            </div>

                            <div class="icon">

                                <i class="ion ion-close-circled"></i>

                            </div>

                            <a href="{{ URL::route('admin_problems') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                        </div>

                    </div>
                    <!-- ./col -->

                </div>

               
				                
        	</section>
            <!-- /.content -->
      
      	</div>
      	<!-- Content Block Ends Here  -->
		
        <!-- Footer Starts Here -->
      	@include('admin.layouts.footer')
    	<!-- Footer Starts Here -->
        
    </div><!-- ./wrapper -->

@stop

@section('js')
	
    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}
    
    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

	{{ HTML::script('assets/js/app.js') }}
    
@stop