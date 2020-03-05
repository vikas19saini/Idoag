@extends('layouts.default')

@section('title',$brand->name.' Internships Students Applied')

@section('css')

    @include('brands.partial.color')

    {{ HTML::style('assets/plugins/ionic/css/ionic.min.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.bootstrap.css') }}

    {{ HTML::style('assets/plugins/dataTables/css/dataTables.responsive.css') }}

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Brand inner Nav start here -->
        @include('brands.partial.inner_nav')
        <!-- Brand inner Nav End here -->

        <div class="brandoffer_info">
            <div class="container_info">
                <div class="intershipapp_details">
                    <div class="intershipapp_list">
                        <h3><img src="http://www.idoag.com/assets/images/note_img3.png"> <span>Received Applications for Internships</span></h3>

                        <div class="row">
                            <div class="alert alert-success hide  avilablestatus">
                                <span></span>
                                <a class="close">&times;</a>
                            </div>
                            <div class="alert alert-danger hide avilablestatus2">
                                <span></span>
                                <a class="close">&times;</a>
                            </div>
                        </div>

                    @if(!isset($filter) && count($internships)==0)
                     @else
                        <div class="receviedshipapp_list">
                            <h4>Search for Internships</h4>
                            <div class="receviedshipapp_form">
                    {{ Form::open(['route' => ['filterInternship', $brand->slug],'files' => true,'class' => 'form-horizontal','id' => 'search_form']) }}
                                 <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">

                        {{ Form::label('institution', 'Institution', ['class' => 'col-sm-5 control-label']) }}

                        <div class="col-sm-7">
                            @if(isset($filter))
                                 {{ Form::select('institution', array('' => 'Select College')+$institutions,$filter['institution'] , ['class' => 'form-control']) }}
                            @else
                                 {{ Form::select('institution', array('' => 'Select College')+$institutions, '' , ['class' => 'form-control']) }}
                            @endif

                        </div>
                    </div>
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status', ['class' => 'col-sm-5 control-label']) }}
                                        <div class="col-sm-7">
                                            @if(isset($filter))
                                               {{ Form::select('status', array('' => 'All') + $internship_status, $filter['status'] , ['class' => 'form-control']) }}
                                            @else
                                               {{ Form::select('status', array('' => 'All') + $internship_status, '' , ['class' => 'form-control']) }}
                                            @endif
                                        </div> </div></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                {{ Form::label('keyword', 'Student Name', ['class' => 'col-sm-5 control-label']) }}
                                   <div class="col-sm-6">
                                    @if(isset($filter))
                                          {{ Form::text('keyword', $filter['keyword'], ['placeholder' => 'Student Name', 'id'=>'keyword','class' => 'form-control']) }}
                                    @else
                                           {{ Form::text('keyword', null, ['placeholder' => 'Student Name', 'id'=>'keyword','class' => 'form-control']) }}
                                    @endif

                                   </div>
                                    </div>

                                    <div class="form-group">
                        {{ Form::label('video', 'Video', ['class' => 'col-sm-5 control-label']) }}

                        <div class="col-sm-6">
                            @if(isset($filter))
                                {{ Form::select('video', array('' => 'All','1' => 'Yes','0' => 'No'),$filter['video'] , ['class' => 'form-control']) }}
                            @else
                                {{ Form::select('video', array('' => 'All','1' => 'Yes','0' => 'No'), '' , ['class' => 'form-control']) }}
                            @endif

                        </div> </div>
                    </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('internship', 'Internship', ['class' => 'col-sm-4 control-label']) }}
                                        <div class="col-sm-8">
                                            @if(isset($filter))
                                                {{ Form::select('internship', array('' => 'Select Internship')+$posts,$filter['internship'] , ['class' => 'form-control']) }}
                                            @elseif(isset($post))
                                                {{ Form::select('internship', array('' => 'Select Internship')+$posts,$post->id , ['class' => 'form-control']) }}
                                            @else
                                                {{ Form::select('internship', array('' => 'Select Internship')+$posts, '' , ['class' => 'form-control']) }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class=" col-sm-offset-4">
                                            {{ Form::submit('Filter', ['class' => 'btn btn-default filter_btn']) }}
                                         @if(isset($filter)) 
                                            <a href="{{route('internships_applied',$brand->slug)}}" class="btn btn-info filter_btn">View All</a>

                                            @endif
                                </div>

                    {{ Form::close() }}
                            </div></div>
                         
                        @endif
						 </div>
</div>
                        <div class="receviedshipapptable_info">

                             <div class="table-responsive">
                     <table id="internships_list" class="table  table-hover">
                        <thead>
                        <tr>

                            <th>S No</th>
                            <th>Student </th>
                            <th>Institution </th>
                            <th>Internship </th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Sent</th>
                            <th></th>
                            <th></th>
                        </tr>

                        </thead>

                        <tbody>

                        @if(count($internships)==0)
                           <tr> <td colspan="8"><div class="norecords_sml">No applications yet @if(isset($filter))with this filter @endif .</div></td></tr>
                           @endif
                        @foreach($internships as $key=>$internship)

                            <tr {{ ($internship->deleted_at!='') ? " class='deleted'" : "" }}>

                                <td>{{ $key+1 }}</td>

                                <td>{{ $internship->name}}</td>
                                <td>{{ $internship->institution }}</td>
                                <td><a href="{{ URL::route('internship_details',array('slug1' => $brand->slug, 'slug2' => $internship->post->slug))}}" target="_blank">{{ getPostName($internship->post_id) }}</a></td>
                               <td>{{$internship->post->category}}</td>
                                {{--<td>  {{ Form::select('status', $internship_status, $internship->status, ['class' => 'form-control','onchange' => 'changeInternshipStatus(this.value,'.$internship->id.')']) }}--}}
                                  {{--</td>--}}
                                <td>{{$internship_status[$internship->status]}}</td>
                                <td>{{ date('Y-m-d', strtotime($internship->created_at)) }}</td>

                                <td class="viewinfo">
                                    <a href="{{ URL::route('student_internship_view', [$brand->slug, $internship->id, $internship->post->slug]) }}"
                                       target="_blank"><i class="fa fa-eye-open"></i> View Info</a></td>

                                <td><span data-form="#frmDelete-{{$internship->id}}"
                                          data-url="{{route('internships.destroy', array($internship->id))}}" data-title="Delete Student Internship"
                                          data-message="Are you sure you want to delete this student internship ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"> <i class="fa fa-trash-o"></i></a>
                                </span>
                                    {{ Form::open(array(
                                            'url' => route('internships.destroy', array($internship->id)),
                                            'method' => 'delete',
                                            'style' => 'display:none',
                                            'id' => 'frmDelete-' . $internship->id
                                        ))
                                    }}
                                    {{ Form::submit('Submit') }}
                                    {{ Form::close() }}
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                        </tfoot>

                    </table>


                </div>



        </div>

    </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->


@stop

@section('js')

    {{ HTML::script('assets/plugins/dataTables/js/jquery.dataTables.min.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.fixedColumns.js') }}

    {{ HTML::script('assets/plugins/dataTables/js/dataTables.bootstrap.min.js') }}

    {{ HTML::script('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}

    {{ HTML::script('assets/plugins/fastclick/fastclick.min.js') }}

    {{ HTML::script('assets/js/app.js') }}

    <script type="text/javascript">

        $(document).ready(function (e) {



            $(".avilablestatus .close").click(function(){
                $(this).parent(".avilablestatus").addClass('hide');
            });
            $(".avilablestatus2 .close").click(function(){
                $(this).parent(".avilablestatus2").addClass('hide');
            });



                @if(count($internships)!=0)

            var table = $('#internships_list').DataTable({

                scrollCollapse: true,

                paging: true,

                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [7,8]}
                ]
            });
                @endif



            $(document).on('click', '#checkall', function (e) {

                var cells = table.cells().nodes();

                $(cells).find(':checkbox').prop('checked', $(this).is(':checked'));

            });

        });

        function changeInternshipStatus(status,id)
        {
            if(id) {

                $.ajax({

                    headers: {
                        'csrftoken' : '{{ csrf_token() }}'
                    },

                    type: 'POST',

                    url: '/changeInternshipStatus',

                    data: { 'id':id,'status':status },

                    success: function(data) {
                        if(data)
                        {
                            $('.avilablestatus2').addClass('hide');
                            $('.avilablestatus').removeClass('hide');
                        $('.avilablestatus span').html('Internship status has been changed!');
                        }
                        else
                        {
                            $('.avilablestatus2').removeClass('hide');
                            $('.avilablestatus2').removeClass('hide');
                            $('.avilablestatus').addClass('hide');
                            $('.avilablestatus2 span').html('Error in updating Internship status!');
                        }
                    }

                });
            }
        }

    </script>

@stop