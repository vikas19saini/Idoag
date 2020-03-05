@extends('layouts.default')
@section('title','Idoag! '.$single->name.' - Internship Application')


@section('css')

    {{ HTML::style('assets/plugins/datepicker/datepicker3.css') }}
    @include('brands.partial.color')


@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->


        <div class="brandoffer_info">
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="notice_feed_list internship_appinfo_list">
                        <div class="internship_appinfo">
                            <h3>{{ HTML::image('assets/images/stdntrecentupdates_img2.png') }} <span>APPLY FOR INTERNSHIP</span><br/>
                                <span>{{$post->name }}  @  {{$brand->name}}</span>
                            </h3>
                        </div>

                        <div class="internship_twocolinfo">
                            <div class="internship_appleft">
                                <p>Please make sure that you absolutely meet the criteria set by
                                    {{$brand->name}} mentioned on the right. An Application once confirmed
                                    cannot be taken back. </p>

                                <p>Please do note that you will be contacting the HR at {{$brand->name}}. Please
                                    be courteous, truthful and open. This might affect your career.</p>


                                {{ Form::open(['route' => 'internships.store', 'class' => 'offers-form','id' => 'internship-form', 'files' => 'true']) }}

                                @include('partials.internship_apply_form')

                                <div class="internshipapp_submit">

                                    {{ Form::submit('APPLY') }}</div>

                                {{ Form::close() }}

                            </div>
                            <div class="internship_appright">
                                <ul>
                                    <li>
                                        <span>Category</span>
                                        <span class="boldtxt">{{$post->category}}</span>
                                    </li>
                                    <li>
                                        <span>Skills Required</span>
                                        <span class="boldtxt">{{$post->skills}}</span>
                                    </li>
                                    <li>
                                        <span>Location</span>
                                        <span class="boldtxt">{{getCity($post->city).', '.getState($post->state)}}</span>
                                    </li>

                                    <li>
                                        <span>Timeframe</span>
                                        <span class="boldtxt">{{$post->start_date}} to {{$post->end_date}}</span>
                                    </li>

                                    <li>
                                        <span>Number of Positions</span>
                                        <span class="boldtxt">{{$post->positions}}</span>
                                    </li>

                                    <li>
                                        <span>Stipend</span>
                                        <span class="boldtxt">@if($post->stipend==1)
                                                Yes - Rs.{{$post->amount}} per month
                                            @else
                                                No
                                            @endif</span>
                                    </li>

                                </ul>


                                {{$post->description}}   </div>

                        </div>

                    </div>

                </div>
                <div class="notice_feed_info internship_list">
                    <div class="notice_feed_list">
                        <h3>{{ HTML::image('assets/images/noteheart_img17.png')}} <span>Recent Updates</span></h3>

                        <div class="studentrecentupdates_list">
                            <ul>

                                @foreach($brands_posts as $post)

                                    @if($post->type == 'offer')

                                        <li>
                                            <a href="{{ URL::route('offer_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img1.png')}}</div>
                                                <div class="studentrecentupdates_cont">
                                                    <strong>{{getBrandName($post->brand_id)}}</strong> posted an offer:
                                                    <strong>{{$post->name}}</strong></div>
                                            </a></li>

                                    @endif


                                    @if($post->type == 'photo')

                                        <li>
                                            <a href="{{ URL::route('photo_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img3.png')}}</div>
                                                <div class="studentrecentupdates_cont">
                                                    <strong>{{getBrandName($post->brand_id)}}</strong> posted a new
                                                    photo gallery.
                                                </div>
                                            </a></li>

                                    @endif


                                    @if($post->type == 'link')

                                        <li>
                                            <a href="{{ URL::route('link_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img5.png')}}</div>
                                                <div class="studentrecentupdates_cont">
                                                    <strong>{{getBrandName($post->brand_id)}}</strong> posted a new
                                                    photo gallery.
                                                </div>
                                            </a></li>

                                    @endif

                                    @if($post->type == 'internship')

                                        <li>
                                            <a href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img2.png')}}</div>
                                                <div class="studentrecentupdates_cont">
                                                    <strong>{{getBrandName($post->brand_id)}}</strong> posted an
                                                    internship : <strong>{{$post->category, $post->city}}</strong></div>
                                            </a></li>

                                    @endif

                                    @if($post->type == 'event')

                                        <li>
                                            <a href="{{ URL::route('event_details',array('slug1' => getBrandSlug($post->brand_id), 'slug2' => $post->slug ))}}">
                                                <div class="studentrecentupdates_img">{{ HTML::image('assets/images/stdntrecentupdates_img4.png')}}</div>
                                                <div class="studentrecentupdates_cont">
                                                    <strong>{{getBrandName($post->brand_id)}}</strong> posted a new
                                                    event : <strong>{{ $post->name}}</strong></div>
                                            </a></li>

                                    @endif

                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="brandsnearyou_info">
                        <h4>Suggested Brands</h4>

                        <div class="suggestedbrands_list">
                            <ul>
                                @foreach($suggested_brands as $suggested_brand)
                                    <li>
                                        <div class="suggestedbrands_cont"><a
                                                    href="{{URL::route('brand_profile',array($suggested_brand->slug))}}">
                                                {{   HTML::image(getImage('uploads/brands/',$suggested_brand->image,'noimage.jpg'))}}
                                            </a>
                                            <h4>
                                                <a href="{{URL::route('brand_profile',array($suggested_brand->slug))}}">{{$suggested_brand->name}}</a>
                                            </h4>

                                            <p>
                                                <a href="javascript:void(0);">{{ HTML::image('assets/images/like4_icon.png')}}
                                                    <span>+ {{getBrandFollowsCount($suggested_brand->id)}}
                                                        followers</span></a></p>

                                            <div class="brandoffer_follow2 id_{{$suggested_brand->id}}"
                                                 id="{{$suggested_brand->id}}"><a href="javascript:void(0);"
                                                                                  class="follow_btn">Follow</a></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
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




                {{ HTML::script('assets/plugins/datepicker/bootstrap-datepicker.js') }}

                <script>

                    $(document).ready(function (e) {

                        $('.suggestedbrands_list ul').bxSlider({
                            pager: false
                        });
                        /* add datepicker */
                        $('#start_date').datepicker({
                            format: 'dd-mm-yyyy',
                        });

                        $('#end_date').datepicker({
                            format: 'dd-mm-yyyy',
                        });

                        /* upload internships image */

                        function readURL(input) {
                            if (input.files && input.files[0]) {

                                var reader = new FileReader();

                                reader.onload = function (e) {

                                    $('.preview_internship').attr('src', e.target.result).fadeIn('slow');

                                };

                                reader.readAsDataURL(input.files[0]);

                            }

                        }

                        $("body").on('change', '.internship_image', function () {

                            readURL(this);

                        });

                    });

                </script>

@stop
