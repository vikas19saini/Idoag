@extends('layouts.default')

@section('title', 'Idoag!  Offers and Discounts - '.$brand->name)

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

                            @if(!$offers)

                                <div class="norecords"> No Offers at present.</div>

                            @endif

                            @foreach($offers as $offer)

                                @include('brands.partial.offer')

                            @endforeach

                        </ul>

                    </div>

                </div>

                <div class="notice_feed_info">

                    @if($user_group=='Students'|| $loggedin_user->brand_id != $brand->id)

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

                    @else

                        <div class="brand_poast_info">

                            <h6>NOTES / FEEDBACK</h6>

                            <i>Replying to a note posts it on the page. Please be careful</i>

                            <div class="brand_notesfeedback_txt">

                                <ul>

                                    @foreach($notes as $note)

                                        <li class="note_{{$note->id}}">

                                            <div class="notice_feed_listinnerimg">

                                                {{ HTML::image('uploads/profiles/'.getUserPicture($note->user_id)) }}

                                            </div>

                                            <div class="notice_feed_listinnercont">

                                                <h6>{{$note->name}}</h6>

                                                <p>{{$note->message}}</p>

                                                <a href="javascript:void(0);" class="reply_message" id="{{$note->id}}">reply</a>

                                                <div class="sendyourownnote_info brand_reply form_{{$note->id}}">

                                                    {{ Form::open(array('id' => 'notesreplyform')) }}

                                                    <div class="note_field">

                                                        {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}

                                                        {{Form::hidden('note_id',$note->id,['id'=>'note_id'])}}
                                                    </div>

                                                    <div class="note_controls">

                                                        {{ Form::submit('Reply',['class'=>'brand_reply_button']) }}

                                                        {{ Form::button('Cancel',['class'=>'brand_reply_button cancel_message', 'id'=>$note->id]) }}

                                                    </div>
                                                    {{ Form::close() }}

                                                </div>

                                            </div>

                                        </li>

                                    @endforeach

                                </ul>

                                <div class="editsettings_btn"><a href="{{URL::route('get_feedback',$brand->slug)}}">view
                                        all notes / feedback</a></div>

                            </div>

                        </div>

                    @endif

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

            $('.brand_reply').hide();

            $('.reply_message').on('click', function () {

                var id = $(this).attr('id');

                $('#' + id).hide();
                $('.form_' + id).show();

            })

            $('.cancel_message').on('click', function () {

                var id = $(this).attr('id');

                $('#' + id).show();
                $('.form_' + id).hide();

            })

            $('#notesreplyform').submit(function () {

                event.preventDefault();

                var replymessage = $('#notes').val();

                var note_id = $('#note_id').val();

                var brand_id = {{$brand->id}};

                var data = "&replymessage=" + replymessage + "&brand_id=" + brand_id + "&note_id=" + note_id;

                $.ajax(
                        {
                            url: '/postNotes',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                if (response) {
                                    $('.note_' + response).hide();
                                    $('.success').html('');

                                    $('.success').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yay! Feedback reply message added. Check in Feedback list page to view all.</h4></div>');
                                }
                            }
                        });
            });
        });

    </script>

@stop
