@extends('layouts.default')

@section('title',$brand->name.' Internships')

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
                    <div class="brandoffer_list newoffer_list">
                        <ul>
                            @if(!$internships)
                                <div class="norecords"> No Internships at present.</div>
                            @endif
                            @foreach($internships as $internship)
                                @include('brands.partial.internship')


                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="notice_feed_info">
                    <div class="notice_feed_info">
                        @if($user_group=='Students')

                            <div class="notice_feed_list">
                                <h3> Notes / Feedback</h3>

                                <div class="notice_feed_listinner">
                                    <ul>

                                        @foreach($notes as $note)

                                            @if($note->replymessage)

                                                <li>
                                                    <div class="notice_feed_listinnerimg"> {{ HTML::image('uploads/profiles/'.getUserPicture($note->user_id)) }} </div>
                                                    <div class="notice_feed_listinnercont">
                                                        <h6>{{$note->name}}</h6>

                                                        <p>{{$note->message}}</p>
                                                        <ul>
                                                            <li>
                                                                <div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div>
                                                                <div class="notice_feed_listinnercont">
                                                                    <h6>{{getBrandName($brand->id)}}</h6>

                                                                    <p>{{$note->replymessage}}</p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>

                                            @endif

                                        @endforeach
                                    </ul>
                                    <div class="sendyourownnote_info">

                                        {{ Form::open(array('id' => 'notesform')) }}

                                        {{ Form::text('notes', null, ['id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}

                                        {{ Form::submit('Send Note') }}

                                        {{ Form::close() }}


                                    </div>
                                </div>
                            </div>
                        @endif
                        @include('partials.ad')
                    </div>
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


    <script>

        $(document).ready(function (e) {

            /* brand statistics slider */
            $('.statistics_slider').bxSlider({

                pager: false

            });

        });

    </script>

@stop
