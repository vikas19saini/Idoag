@extends('layouts.default')

@section('title',$brand->name.' Outlets')

@section('css')

    @include('brands.partial.color')

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

                <div class="brandoffer_contleft">

                    <div class="brandoffer_list dashboard_outlet">

                        <div class="export_btns">

                            <div class="btns_border">
                                <h4 class="fl">Outlets</h4> 

                                <div class="form-group">
                                    <input type="text" class="search_outlet form-control" id="search_input" placeholder="Search">
                                </div>
                            </div>
                            
                            <div class="fl">

                                @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                                    <span class="addoutlet_btn"><a
                                                href="{{ URL::route('create_outlet',array('slug'=>$brand->slug))}}">{{ HTML::image("assets/images/addoutlet_icon.png") }}
                                            Add Outlet</a></span>
                                    <span class="import_btn"><a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#outlets-import">{{ HTML::image("assets/images/import_icon.png") }}
                                            Import</a></span>
                                    <span class="delete_btn"><a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#outlets-delete">{{ HTML::image("assets/images/remove_icon_sm.png") }}
                                            Delete All</a></span>
                                    <!-- <span class="sampleexcel_btn"><a href="{{ URL::route('sample_outlets') }}">{{ HTML::image("assets/images/excel_icon.png") }}Sample Excel</a></span> -->
                                    <span class="sampleexcel_btn"><a href="{{ URL::route('sample_outlets') }}">Sample
                                            Excel</a></span>

                                @endif

                            </div>

                        </div>

                        @if(count($outlets)==0)

                            <div class="norecords"> <a href="{{ URL::route('create_outlet',array('slug'=>$brand->slug))}}" target="_blank">Click here</a> to Add Outlets.</div>

                        @else

                            <div class="search_outlets"> </div>

                            <div class="original_outlets">
                                
                                @foreach($outlets as $key=>$outlet)
                                    
                                    @if($key%3==0)
                                        
                                        <div class="outlettable-row"> 

                                    @endif
                                            
                                            <div class="registoff_info">

                                                <h4>{{ $outlet->name }}</h4>

                                                <ul>

                                                    <li>

                                                        <div class="outlet_locaicon"> {{ HTML::image('assets/images/location_icon.png')}}</div>

                                                        <div class="outlet_locacnt">
                                                            @if($outlet->address!='')
                                                                {{ $outlet->address.', '}}
                                                            @endif
															@if($outlet->locality!='')
                                                            {{ $outlet->locality.', '}}  
															 @endif
                                                            @if($outlet->city!='')
                                                                {{ $outlet->city.', '}}
                                                            @endif
                                                            {{ $outlet->state}}
                                                        </div>

                                                    </li>

                                                    @if($outlet->contact_info != '')

                                                        <li>
                                                            <div class="outlet_locaicon"> {{ HTML::image('assets/images/office_callicon.png')}}</div>

                                                            <div class="outlet_locacnt">{{ $outlet->contact_info}}</div>
                                                        </li>

                                                    @endif

                                                </ul>

                                                @if(isset($loggedin_user) && $loggedin_user->brand_id == $brand->id)

                                                    <span class="edit_del-btns">
                            
                                                        <a href="{{ URL::route('update_outlet',array('slug'=>$brand->slug,'id'=>$outlet->id))}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>
                                                        
                                                        <span data-form="#frmDelete-{{$outlet->id}}" data-title="Delete Outlet" data-message="Are you sure you want to delete this Outlet ?">
                                                            
                                                            <a class="formConfirm" href="" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                        
                                                        </span>

                                                            {{ Form::open(array(
                                                                    'url' => route('outlets.destroy', array($outlet->id)),
                                                                    'method' => 'delete',
                                                                    'style' => 'display:none',
                                                                    'id' => 'frmDelete-' . $outlet->id
                                                                ))
                                                            }}
                                                            {{ Form::submit('Submit') }}
                                                            {{ Form::close() }}

                                                    </span>

                                                @endif

                                            </div>

                                        @if($key%3==2)
                                        
                                        </div> 
                                        
                                        @endif

                                @endforeach

                                @if($key%3!=2)
                                
                                    </div>

                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            </div>

            <div class="notice_feed_info">

                @include('partials.ad')
            </div>

        </div>

    </div>

    </div>
    <!-- Content Ends Here -->

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

    <!-- Import modal starts Here -->
    <div class="modal fade" id="outlets-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content outletsimport_modal-content">

                <div class="modal-header outletsimport_modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        {{ HTML::image('/assets/images/popup_close.png') }}
                    </button>

                    <h4 class="modal-title">Import Outlets</h4>

                </div>

                <div class="modal-body outletsimport_modal-body">

                    {{ Form::open(['route' => 'brands_outlets_import', 'class' => 'form-horizontal','id' => 'outlets-import-form', 'files' => true]) }}

                    <div class="form-group">

                        {{ Form::label('Import Excel', 'Import Excel File', ['class' => 'col-sm-4 control-label']) }}

                        <div class="col-sm-8">

                            {{ Form::file('file', ['required' => 'required']) }}

                            {{ errors_for('file', $errors) }}

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-8">

                            {{ Form::submit('Import Outlets', ['class' => 'btn btn-lg btn-info btn-block']) }}

                        </div>

                    </div>

                    {{ Form::close() }}

                </div>

            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- Import modal Ends Here -->

    <div class="modal fade" id="outlets-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content outletsimport_modal-content">

                <div class="modal-header outletsimport_modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        {{ HTML::image('/assets/images/popup_close.png') }}
                    </button>

                    <h4 class="modal-title">Delete Outlets</h4>

                </div>

                <div class="modal-body outletsimport_modal-body">

                    {{ Form::open(['route' => 'brands_outlets_delete', 'class' => 'form-horizontal','id' => 'outlets-import-form', 'files' => true]) }}

                    <div class="form-group" style="text-align: center">

                        Need confirm. Are you sure to delete all outlets.

                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-8">

                            {{ Form::submit('Delete All Outlets', ['class' => 'btn btn-lg btn-info btn-block']) }}

                        </div>

                    </div>

                    {{ Form::close() }}

                </div>

            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>

@stop

@section('js')


    <script>

        $(document).ready(function (e) {

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

            var timer;

            $("#search_input").keyup(function(){

                var keywords = $('#search_input').val();

                var brand_id = "{{$brand->id}}";

                timer = setTimeout(function()
                {

                    if(keywords.length > 0)
                    {
                        $.post('<?php echo url()?>/searchOutlet',{keywords: keywords,brand_id: brand_id},function(response){

                            if(response)
                            {
                                $('.original_outlets').hide();
                                $('.search_outlets').html(response);
                            }
                        });
                    }
                    else
                    {
                         $('.original_outlets').show();
                        $('.search_outlets').html('');
                    }
                }, 500);
            });


            $("#search_input").keydown(function(){

                clearTimeout(timer);

            });
        });

    </script>

@stop