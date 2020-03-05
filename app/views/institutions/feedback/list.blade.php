@extends('layouts.default')

@section('title',$institution->name.' Feedbacks')

@section('css')

    @include('institutions.partial.color')

@stop

@section('content')

    <!-- Content Start Here -->
    <div class="wrapper">

        <!-- Header Starts here -->
        @include('layouts.header')
        <!-- Header Ends here -->

        <!-- Institution inner Nav start here -->
        @include('institutions.partial.inner_nav')
        <!-- Institution inner Nav End here -->

        <div class="brandoffer_info">
            <div class="success"></div>
            <div class="container_info">
                <div class="brandoffer_contleft">
                    <div class="notice_feed_list">
                        <div class="notice_feed_listinner">
                            @if(count($feedbacks)==0)
                                <div class="norecords"> No Feedback.</div>
                            @endif
                            <ul>
                                @foreach($feedbacks as $note)
                                    <li>
                                        @if(isset($institution) && $loggedin_user->institution_id == $institution->id)
                                            <div style="float:right">
                                               <span data-form="#frmDelete-{{$note->id}}" data-title="Delete Note"
                                                     data-message="Are you sure you want to delete this Note ?">
                                    <a class="formConfirm" href="" data-toggle="tooltip" data-placement="bottom"
                                       title="Delete"> {{ HTML::image('assets/images/remove_icon.png')}}</a>
                                </span>
                                                {{ Form::open(array(
                                                        'url' => route('feedback.destroy', array($note->id)),
                                                        'method' => 'delete',
                                                        'style' => 'display:none',
                                                        'id' => 'frmDelete-' . $note->id
                                                    ))
                                                }}
                                                {{ Form::submit('Submit') }}
                                                {{ Form::close() }}

                                            </div>
                                        @endif
                                        <div class="notice_feed_listinnerimg">  {{   HTML::image(getImage('uploads/profiles/',getUserPicture($note->user_id),'noimage.jpg'))}}</div>
                                        <div class="notice_feed_listinnercont">
                                            <h6>{{$note->name}} <span class="txtblack">at {{$note->created_at}}</span>
                                            </h6>

                                            <p>{{$note->message}}</p>
                                            <ul>
                                                <li class="note_{{$note->id}}">

                                                    @if($note->replymessage!='')


                                                        <div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div>
                                                        <div class="notice_feed_listinnercont">
                                                            <h6>{{getInstitutionName($institution->id)}} <span
                                                                        class="txtblack">at {{$note->updated_at}}</span>
                                                            </h6>

                                                            <p>{{$note->replymessage}}</p>
                                                        </div>


                                                    @else

                                                        <a href="javascript:void(0);" class="reply_message"
                                                           id="{{$note->id}}">reply</a>

                                                        <div class="sendyourownnote_info brand_reply form_{{$note->id}}">

                                                            {{ Form::open(array('id' => 'notesreplyform')) }}

                                                            <div class="note_field">

                                                                {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Institution!']) }}

                                                                {{Form::hidden('note_id',$note->id,['id'=>'note_id'])}}
                                                            </div>

                                                            <div class="note_controls">

                                                                {{ Form::submit('Reply',['class'=>'brand_reply_button submit_reply']) }}

                                                                {{ Form::button('Cancel',['class'=>'brand_reply_button cancel_message', 'id'=>$note->id]) }}

                                                            </div>
                                                            {{ Form::close() }}

                                                        </div>
                                                    @endif


                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                @endforeach
                            </ul>
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

@stop

@section('js')



    <script>

        $(document).ready(function (e) {

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

                var institution_id = {{$institution->id}};

                var data = "&replymessage=" + replymessage + "&institution_id=" + institution_id + "&note_id=" + note_id;

                $.ajax(
                        {
                            url: '/postInstNotes',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                if (response) {

                                    $('.success').html('');

                                    $('.success').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yay! Feedback reply message added.</h4></div>');


                                    $('.note_' + response).html('<div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div><div class="notice_feed_listinnercont"><h6>{{getInstitutionName($institution->id)}} </h6><p>' + replymessage + '</p></div>');
                                }
                            }
                        });
            });
            /* brand statistics slider */
            $('.statistics_slider').bxSlider({
                pager: false
            });

        });

    </script>

@stop
