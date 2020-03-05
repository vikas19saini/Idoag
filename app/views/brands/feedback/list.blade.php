@extends('layouts.default')

@section('title',$brand->name.' Feedbacks')

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
                                        @if(isset($brand) && $loggedin_user->brand_id == $brand->id)
                                            <div style="float:right">
                                               
                                               <span data-url="{{ URL::route('feedback_delete', [$note->id]) }}"
                                                     data-title="Delete Note"
                                                     data-message="Are you sure you want to delete this Note ?">
<a class="formConfirmSingle trash_icon" href="" data-toggle="tooltip" data-placement="bottom" title="Delete"> <i
            class="fa fa-trash-o"></i></a>
                                                </span>

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
                                                            <h6>{{getBrandName($brand->id)}} <span
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

                                                                {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Brand!']) }}

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

    {{ HTML::script('assets/js/notescript.js') }}


    <script>

        $(document).ready(function (e) {

            $('.submit_reply').on('click', function (e) {

                e.preventDefault();

                var replymessage = $('#notes').val();

                var note_id = $('#note_id').val();

                var brand_id = $('#brandid').val();

                var data = "&replymessage=" + replymessage + "&brand_id=" + brand_id + "&note_id=" + note_id;

                $.ajax(
                        {
                            url: '/postNotes',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                if (response) {

                                    $('.success').html('');

                                    $('.success').append('<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Yay! Feedback reply message added.</h4></div>');


                                    $('.note_' + response).html('<div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div><div class="notice_feed_listinnercont"><h6>{{getBrandName($brand->id)}} </h6><p>' + replymessage + '</p></div>');
                                }
                            }
                        });
            });

        });

    </script>

@stop
