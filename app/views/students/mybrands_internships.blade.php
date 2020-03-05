@extends('layouts.default')

@section('title','Internships for Students |idoag.com')
@section('metatags')
   <meta name="keywords" content="Internships for Students |idoag.com" />
    <meta name="description" content="Internships for Students |idoag.com" />

@stop

@section('css')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->
        @include('partials.flash')
        <div class="container_info">
        <div class="notice_feed_info internship_list">
  <h3> Internships from My Brands<a href="{{ URL::route('internships')}}" class="btn btn-primary mobile_back_btn"><i class="fa fa-angle-left"></i> Back</a></h3>
            <div class="notice_feed_list">
                <div class="notice_feed_listinner2">
                    <ul>
                        @foreach($mybrands_internships as $internship)

                            <li>
                               

                                    <a  @if(Sentry::check()) href="{{ URL::route('internship_details',array('slug1' => getBrandSlug($internship->brand_id), 'slug2' => $internship->slug ))}}"   @else  href="#" data-toggle="modal"  data-target="#login_required" class="login_btnpop"  @endif>

                                                <div class="notice_feed_listinnerimg">{{ HTML::image(getImage('uploads/photos/',$internship->image,'noimage.jpg'))}}</div>

                                                <div class="notice_feed_listinnercont">

                                                    <h5>{{$internship->name}}</h5>

                                                    <p>{{ShortenText($internship->short_description,100)}} <br>

                                                        <i>by {{getBrandName($internship->brand_id)}}</i>
                                                    </p>

                                                </div>
                                            </a>
                            </li>


                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
            </div>

    </div>

    <!-- Footer Starts here -->
    @include('layouts.footer')
    <!-- Footer Ends here -->

@stop
