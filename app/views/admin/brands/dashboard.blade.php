@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Brands Dashboard')

@section('class', 'skin-blue fixed')

@section('css')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}

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

                <h1>

                    Brand Dashboard - {{$brand->name}}

                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_brands') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back to Brands</a>
        </ol>

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">

                    <div class="col-lg-12">

                            @include('admin.layouts.flash')

                            <div class="box box-primary">

                                <div class="box-body">

                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                                            <li><a href="#offers" data-toggle="tab">Offers</a></li>
                                            <li><a href="#internships" data-toggle="tab">Internships</a></li>
                                            <li><a href="#text" data-toggle="tab">Text</a></li>
                                            <li><a href="#events" data-toggle="tab">Events</a></li>
                                            <li><a href="#photos" data-toggle="tab">Photos</a></li>
                                            <li><a href="#outlets" data-toggle="tab">Outlets</a></li>
                                            <li><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li><a href="#problems" data-toggle="tab">Report Problem</a></li>
                                            <li><a href="#followers" data-toggle="tab">Followers</a></li>
                                            <li><a href="#statistics" data-toggle="tab">Statistics</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="profile">

                                                <p>
                                                    <strong>Brand Name :</strong> {{ $brand->name}}</p>
                                                <p>
                                                    <strong>Category :</strong> {{ $brand->category}}</p>
                                                <p><strong>Site URL :</strong> {{ $brand->url}} </p>
                                                <p><strong>Facebook :</strong>  {{ $brand->facebook}}</p>
                                                <p><strong>Twitter :</strong>  {{ $brand->twitter}}</p>
                                                <p><strong>Priority :</strong>  {{ $brand->priority}}</p>
                                                <p> <strong>Created on:</strong> {{ $brand->created_at}}</p>
                                                <p><strong>Last Updated :</strong>  {{ $brand->updated_at}}</p>
                                                <p>
                                                    <strong>Status:  Active </strong> </p>
                                                   <p>
                                                    <strong>Description: </strong> </p>
                                                {{ $brand->description}}
                                                <p><strong>Location (PanIndia) :</strong>  {{ $brand->panindia}}</p>
                                            @if($brand->city)<p><strong>City :</strong> {{ getCity($brand->city)}}</p>@endif
                                                @if($brand->state)<p><strong>State :</strong> {{ getState($brand->state)}} </p>@endif
                                                @if($brand->institution_id)<p><strong>Pan India Institution :</strong> {{ getInstitutionName($brand->institution_id)}}</p>@endif
                                                <p><strong>Brand Color :</strong> {{ $brand->color1 }} </p>
                                                <p><strong>Logo :</strong><br/>
                                                    @if($brand->image!='')
                                                        {{ HTML::image('/uploads/brands/'.$brand->image, '', ['height'=>'200']) }}
                                                    @endif  </p>
                                                <p><strong>Cover Image :</strong><br/>
                                                    @if($brand->coverimage!='')
                                                        {{ HTML::image('/uploads/brandcover/'.$brand->coverimage, '', ['class' => 'slider-img','height'=>'200']) }}
                                                    @endif </p>
                                                <p>&nbsp;</p>
                                                <h4>Brand Users</h4>
                                                <table class="table table-striped table-bordered table-hover" id="brandusers">
                                                    <thead>
                                                    <tr>
                                                        <th>SNo</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Last Login </th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($brand_users as $key=>$user)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td>
                                                            <td> {{$user->email}} </td>
                                                            <td>{{$user->lastlogin}}</td>
                                                            <td> @if($user->activated)Active  @else  Deactive @endif </td>
                                                            <td>
                                                                <a href="{{ URL::route('admin.brandsusers.edit', [$user->id]) }}" title="Edit" class="btn btn-small btn-info">Edit</a></td>
                                                        </tr>
                                                     @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="offers">
                                                <div class="dataTable_wrapper">
                                                <table class="table table-striped table-bordered table-hover" id="brandoffers">
                                                    <thead>
                                                    <tr>
                                                        <th>SNo</th>
                                                        <th>Name</th>
                                                        <th>Pictures</th>
                                                        <th>Offer</th>
                                                        <th>Status</th>
                                                        <th>Updated At</th>
                                                         <th>Edit</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($offers as $key => $offer)
                                                         <tr {{ ($offer->deleted_at!='') ? " class='deleted'" : "" }}>

                                                            <td>{{ $key+1 }}</td>

                                                            <td>{{ ucfirst($offer->name) }}</td>

                                                            <td>@if($offer->image!='') {{ HTML::image('uploads/photos/'.$offer->image, '', ['class' => 'admin_thumbnail']) }} @endif
                                                            </td>

                                                            <td>{{ $offer->offer_value }}@if($offer->offer_type=='percentage')%@endif</td>

                                                            <td>@if($offer->status)Active  @else  InActive @endif </td>

                                                            <td>{{ date('Y-M-d H:i:s', strtotime($offer->updated_at)) }}</td>

                                                            <td><a href="{{ URL::route('admin.offers.edit', [$offer->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                    </div>
                                            </div>

                                            <div class="tab-pane" id="internships">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandinternships">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Name</th>
                                                            <th>Pictures</th>
                                                            <th>Skills</th>
                                                            <th>Positions</th>
                                                            <th>Status</th>
                                                            <th>Updated At</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($internships as $key => $internship)
                                                            @if($internship->deleted_at=='')
                                                                <tr {{ ($internship->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{ ucfirst($internship->name) }}</td>

                                                                    <td>@if($internship->image!='')  {{ HTML::image('uploads/photos/'.$internship->image, '', ['class' => 'admin_thumbnail']) }}@endif</td>

                                                                    <td>{{ $internship->skills }}</td>

                                                                    <td>{{ $internship->positions }}</td>

                                                                    <td>@if($internship->status)Active  @else  InActive @endif </td>

                                                                    <td>{{ date('Y-M-d H:i:s', strtotime($internship->updated_at)) }}</td>

                                                                    <td><a href="{{ URL::route('admin.internships.edit', [$internship->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="events">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandevents">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Name</th>
                                                            <th>Pictures</th>
                                                            <th>Event Date</th>
                                                            <th>Status</th>
                                                            <th>Updated At</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($events as $key => $event)
                                                            @if($event->deleted_at=='')
                                                                <tr {{ ($event->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{ ucfirst($event->name) }}</td>

                                                                    <td>@if($event->image!=''){{ HTML::image('uploads/photos/'.$event->image, '', ['class' => 'admin_thumbnail']) }}@endif</td>

                                                                    <td>{{ $event->start_date }}</td>

                                                                    <td>@if($event->status)Active  @else  InActive @endif </td>

                                                                    <td>{{ date('Y-M-d H:i:s', strtotime($event->created_at)) }}</td>

                                                                    <td><a href="{{ URL::route('admin.events.edit', [$event->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="text">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandtext">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th>Updated At</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($texts as $key => $text)
                                                            @if($text->deleted_at=='')
                                                                <tr {{ ($text->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{ ucfirst($text->name) }}</td>

                                                                    <td>@if($text->status)Active  @else  InActive @endif </td>

                                                                    <td>{{ date('Y-M-d H:i:s', strtotime($text->created_at)) }}</td>

                                                                    <td><a href="{{ URL::route('admin.links.edit', [$text->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="outlets">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandoutlets">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Name</th>
                                                            <th>Address</th>
                                                            <th>Contact Info</th>
                                                            <th>Updated At</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($outlets as $key => $outlet)
                                                            @if($outlet->deleted_at=='')
                                                                <tr {{ ($outlet->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{ $outlet->name }}</td>

                                                                    <td>  @if($outlet->address!='')
                                                                            {{ $outlet->address.', '}}
                                                                        @endif
                                                                        {{ $outlet->locality}} <br/>
                                                                        @if($outlet->city!='')
                                                                            {{ $outlet->city.', '}}
                                                                        @endif
                                                                        {{ $outlet->state}}</td>

                                                                    <td>{{ $outlet->contact_info}} </td>

                                                                    <td>{{ date('Y-M-d H:i:s', strtotime($outlet->updated_at)) }}</td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="photos">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandphotos">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Name</th>
                                                            <th>Picture</th>
                                                            <th>Status</th>
                                                            <th>Updated At</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($photos as $key => $photo)
                                                            @if($photo->deleted_at=='')
                                                                <tr {{ ($photo->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{ ucfirst($photo->name) }}</td>

                                                                    <td>@if($photo->image!=''){{ HTML::image('uploads/photos/'.$photo->image, '', ['class' => 'admin_thumbnail']) }}@endif</td>

                                                                    <td>@if($photo->status)Active  @else  InActive @endif </td>

                                                                    <td>{{ date('Y-M-d H:i:s', strtotime($photo->created_at)) }}</td>

                                                                    <td><a href="{{ URL::route('admin.photos.edit', [$photo->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="feedback">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandfeedbacks">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>User</th>
                                                            <th>Message</th>
                                                            <th>Reply Message</th>
                                                            <th>Replied At</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($feedbacks as $key => $note)
                                                                 <tr {{ ($note->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                    <td>{{ $key+1 }}</td>

                                                                    <td>{{$note->name}} <span class="txtblack">at {{$note->created_at}}</span></td>

                                                                    <td>{{$note->message}}</td>

                                                                    <td>{{$note->replymessage}}</td>

                                                                    <td><span
                                                                                class="txtblack">at {{$note->updated_at}}</span></td>

                                                                </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="followers">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandfollowers">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Picture</th>
                                                            <th>Name</th>
                                                            <th>Email</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($followers as $key => $user)
                                                            <tr>

                                                                <td>{{ $key+1 }}</td>

                                                                <td>{{ HTML::image(getImage('uploads/profiles/',$user->profile_image,'noimage.jpg'), '', ['class' => 'admin_small_thumbnail']) }}</td>

                                                                <td>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td>
                                                                <td> {{$user->email}} </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="problems">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="brandproblems">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>User Name</th>
                                                            <th>Post Info</th>
                                                            <th>Reason</th>
                                                            <th> Message</th>
                                                            <th>Status</th>
                                                            <th>Date Sent</th>
                                                            <th>Comments</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($problems as $key => $problem)
                                                            <tr {{ ($problem->deleted_at!='') ? " class='deleted'" : "" }}>

                                                                <td>{{ $key+1 }}</td>

                                                                <td>{{ getUserName($problem->user_id)}}</td>

                                                                <td><a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($problem->brand_id), 'slug2' => $problem->slug ))}}" target="_blank">{{ $problem->name }}</a></td>

                                                                <td>{{ $problem->reason }}</td>

                                                                <td>{{ $problem->message}}</td>

                                                                <td>{{ ($problem->status==0)?'Pending':'Closed'}}</td>

                                                                <td>{{ $problem->created_at}}</td>

                                                                <td>{{ $problem->admin_comments}}</td>

                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="statistics">

                                                <p><strong>Total Offers :</strong> {{ $statistics['offer_count'] }}</p>

                                                <p><strong>Total Internships :</strong> {{ $statistics['internship_count'] }}</p>

                                                <p><strong>Total Photos :</strong> {{ $statistics['photo_count'] }}</p>

                                                <p><strong>Total Events :</strong> {{ $statistics['event_count'] }}</p>

                                                <p><strong>Total Text :</strong> {{ $statistics['link_count'] }}</p>

                                                <p><strong>Total Outlets :</strong> {{ $statistics['outlet_count'] }}</p>

                                                <p><strong>Feedback (Total/Not Replied) :</strong> {{ $statistics['total_feedback_count'] }}
                                                            /{{$statistics['total_not_replied']}}</p>

                                                <p><strong>Internships Received from Students :</strong>  {{ $statistics['applied_internships_count'] }}</p>

                                                <p> <strong>Brand Followers from last one month : </strong> {{$statistics['month_followers']}}</p>

                                                <p> <strong>Posts visits for last one month :</strong> {{$statistics['posts_visits_count']}}</p>

                                                <p> <strong>Post Likes for last one month : </strong> {{$statistics['posts_likes_count']}}</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                  <!-- /.box-body -->

                            </div>
                            <!-- /.box -->

                        </div><!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
            </section>
            <!-- /.content -->



        </div>
        <!-- Content Block Ends Here  -->

        <!-- Footer Starts Here -->
        @include('admin.layouts.footer')
        <!-- Footer Starts Here -->

    </div>
    <!-- ./wrapper -->


@stop

@section('js')

    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}

    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script type="text/javascript">

        $(document).ready(function(e) {

            var table = $('#brandusers').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 5 ] }
                ]
            } );

            var table = $('#brandoffers').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 6 ] }
                ]
            } );

            var table = $('#brandinternships').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [7 ] }
                ]
            } );

            var table = $('#brandevents').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 6 ] }
                ]
            } );

            var table = $('#brandphotos').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 5 ] }
                ]
            } );

            var table = $('#brandtext').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 4 ] }
                ]
            } );
			
			 var table = $('#brandfeedbacks').DataTable( {
                paging:         true 
            } );
			
			 var table = $('#brandproblems').DataTable( {
                paging:         true 
            } );
			
			 var table = $('#brandfollowers').DataTable( {
                paging:         true 
            } );
			
			 var table = $('#brandoutlets').DataTable( {
                paging:         true 
            } );
			
			


        });

    </script>

@stop