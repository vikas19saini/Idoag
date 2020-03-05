@extends('admin.layouts.default')

@section('title','Idoag.com | Admin Institutions Dashboard')

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

                    Institution Dashboard - {{$institution->name}}



                </h1>

                <ol class="breadcrumb">

                    <a href="{{ URL::route('admin_institutions') }}" class="btn btn-primary"><i class="glyphicon glyphicon-chevron-left"></i> Back to Institutions</a>
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
                                            <li><a href="#text" data-toggle="tab">Text</a></li>
                                            <li><a href="#events" data-toggle="tab">Events</a></li>
                                            <li><a href="#photos" data-toggle="tab">Photos</a></li>
                                            <li><a href="#feedback" data-toggle="tab">Feedback</a></li>
                                            <li><a href="#members" data-toggle="tab">Members</a></li>
                                            <li><a href="#followers" data-toggle="tab">Followers</a></li>
                                            <li><a href="#statistics" data-toggle="tab">Statistics</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="profile">

                                                <p>
                                                    <strong>Institution Name :</strong> {{ $institution->name}}</p>
                                                   <p><strong>Facebook :</strong>  {{ $institution->facebook}}</p>
                                                <p><strong>Twitter :</strong>  {{ $institution->twitter}}</p>
                                                <p><strong>Priority :</strong>  {{ $institution->priority}}</p>
                                                <p> <strong>Created on:</strong> {{ $institution->created_at}}</p>
                                                <p><strong>Last Updated :</strong>  {{ $institution->updated_at}}</p>
                                                <p>
                                                    <strong>Status:  Active </strong> </p>
                                                   <p>
                                                    <strong>Description: </strong> </p>
                                                {{ $institution->description}}

                                            @if($institution->city)<p><strong>City :</strong> {{ getCity($institution->city)}}</p>@endif
                                                @if($institution->state)<p><strong>State :</strong> {{ getState($institution->state)}} </p>@endif
                                                <p><strong>Institution Color :</strong> {{ $institution->color1 }} </p>
                                                <p><strong>Logo :</strong><br/>
                                                    @if($institution->image!='')
                                                        {{ HTML::image('/uploads/institutions/'.$institution->image, '', ['height'=>'200']) }}
                                                    @endif  </p>
                                                <p><strong>Cover Image :</strong><br/>
                                                    @if($institution->coverimage!='')
                                                        {{ HTML::image('/uploads/instcover/'.$institution->coverimage, '', ['class' => 'slider-img','height'=>'200']) }}
                                                    @endif </p>
                                                <p>&nbsp;</p>
                                                <h4>Institution Users</h4>
                                                <table class="table table-striped table-bordered table-hover" id="instusers">
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
                                                    @foreach ($inst_users as $key=>$user)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{ucfirst($user->first_name).' '.ucfirst($user->last_name)}}</td>
                                                            <td> {{$user->email}} </td>
                                                            <td>{{$user->lastlogin}}</td>
                                                            <td> @if($user->activated)Active  @else  Deactive @endif </td>
                                                            <td>
                                                                <a href="{{ URL::route('admin.institutions_users.edit', [$user->id]) }}" title="Edit" class="btn btn-small btn-info">Edit</a></td>
                                                        </tr>
                                                     @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="events">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="instevents">
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

                                                                    <td><a href="{{ URL::route('admin.inst_events.edit', [$event->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="text">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="insttext">
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

                                                                    <td><a href="{{ URL::route('admin.inst_links.edit', [$text->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="photos">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="instphotos">
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

                                                                    <td><a href="{{ URL::route('admin.inst_photos.edit', [$photo->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>

                                                                </tr>@endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="feedback">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="instfeedbacks">
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

                                            <div class="tab-pane" id="members">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="instmembers">
                                                        <thead>
                                                        <tr>
                                                            <th>SNo</th>
                                                            <th>Picture</th>
                                                            <th>Name</th>
                                                            <th>Email</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($members as $key => $user)
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

                                            <div class="tab-pane" id="followers">
                                                <div class="dataTable_wrapper">
                                                    <table class="table table-striped table-bordered table-hover" id="instfollowers">
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

                                            <div class="tab-pane" id="statistics">

                                                <p><strong>Total Photos :</strong> {{ $statistics['photo_count'] }}</p>

                                                <p><strong>Total Events :</strong> {{ $statistics['event_count'] }}</p>

                                                <p><strong>Total Text :</strong> {{ $statistics['link_count'] }}</p>

                                                <p><strong>Feedback (Total/Not Replied) :</strong> {{ $statistics['total_feedback_count'] }}
                                                            /{{$statistics['total_not_replied']}}</p>

                                                <p> <strong>Institution Followers from last one month : </strong> {{$statistics['month_followers']}}</p>

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

            var table = $('#instusers').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 5 ] }
                ]
            } );

            var table = $('#instmembers').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 1 ] }
                ]
            } );

            var table = $('#instevents').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 6 ] }
                ]
            } );

            var table = $('#instphotos').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 5 ] }
                ]
            } );

            var table = $('#insttext').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 4 ] }
                ]
            } );
			
			 var table = $('#instfollowers').DataTable( {
                paging:         true,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [1 ] }
                ]
            } );
			
			 var table = $('#instfeedbacks').DataTable( {
                paging:         true 
            } );
			
			



        });

    </script>

@stop