@extends('layouts.default')

@section('title','Idoag! '.$brand->name.' Followers')

@section('css')

    @include('brands.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        @include('brands.partial.inner_nav')

        <div class="brandoffer_info followers_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="mybrandoffer_list">
                        <h2>Followers</h2>
                        @if(count($followers)==0)
                            <div class="norecords"> No Followers.</div>
                        @endif
                        <div class="row"> 

                            <div class = "followers_list">
                                @foreach($followers as $follower)        


                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 follower_thumbinfo">
                                        <div class="follower_thumb">
                                            {{ HTML::image(getImage('uploads/profiles/',$follower->profile_image,'noimage.jpg'), $follower->first_name, ['class' => 'slider-img']) }}
                                            <br/>
                                            <h4>{{$follower->first_name}}</h4></div>
                                    </div>

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="notice_feed_info">
                    @include('brands.partial.note')
                    @include('partials.ad')
                </div>
            </div>
        </div>

    </div>
    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop

@section('js')

    {{--HTML::script('assets/js/notescript.js') --}}

<script>


    $(document).ready(function() {


        var process = true;

        var path = window.location.pathname;

        var offset = 1;
        var limit  = 12;
        var slug   = "{{$brand->slug}}"
        var total  = "{{ gettotalfollowers($brand->slug) }}"; 
        //console.log(total);

        $(window).scroll(function() {

            if( process && $(window).scrollTop() + $(window).height() > $('.followers_list').height()) {
            
                process = false;
                
                offset++;

                if(total > (offset - 1 ) * limit)
                {
                   // alert("ifdd");

                    var data = "&offset="+offset+"&total="+total+"&limit="+limit+"&slug="+slug;
                        
                    $.ajax(
                    {
                        url : '/getfollowers',
                        type: 'POST',
                        data : data,
                        success: function(response) 
                        {
                            if(response)
                            {
                                $('#load_more').fadeOut();
                                $('.followers_list').append(response);
                            }
                        }
                    }).always(function(){
                            process = true;
                        });
                }  
                else 
                {  // alert("else");
                    $('#load_more').fadeIn();
                    $('#load_more').html('');//message for end of offers
                }
            }
        
        });

    });

</script>

@stop
