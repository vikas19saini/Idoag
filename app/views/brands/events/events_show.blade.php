@extends('layouts.default')

@section('title', $brand->name.' Events |idoag.com')

@section('metatags')
    <meta name="keywords" content="{{$brand->name}} Events |idoag.com"/>
    <meta name="description" content="{{$brand->name}} Events |idoag.com"/>
@stop

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
                    <div class="brandoffer_list">

                        <ul>
                            @if(count($events)==0)
                                <div class="allnotfund_msg">
                                    <div class="allnotfund_msgleft">{{ HTML::image('assets/images/event_icon.png')}} </div>
                                    <div class="allnotfund_msgright">
                                        @if(isset($loggedin_user) && isset($brand) && $loggedin_user->brand_id == $brand->id)
                                            <p><span class="bold_msg"> You have no events running currently. Host a  <a
                                                            href="{{ URL::route('create_events',$brand->slug)}}">New
                                                        Event</a> today to create an aspirational value for Students.</span>
                                            </p>
                                        @else
                                            <p>
                                                <span class="bold_msg">No Events Available Currently from {{$brand->name}}</span><br/>
                                                Kindly bear with us for sometime.</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @foreach($events as $event)
                                @include('brands.partial.event')
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('brands.partial.note')
                    @include('partials.ad')
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

    {{ HTML::script('assets/js/notescript.js') }}

    <script type="text/javascript">

    </script>
@stop
