@if(Sentry::check())

    @if($loggedin_user->institution_id != $institution->id)
        <div class="notice_feed_list">
            <h6> Notes / Feedback</h6>

            <div class="notice_feed_listinner">
                <ul>

                    @foreach($notes as $note)

                        <li>
                            <div class="notice_feed_listinnerimg">
                                {{   HTML::image(getImage('uploads/profiles/',getUserPicture($note->user_id),'noimage.jpg'))}}
                            </div>
                            <div class="notice_feed_listinnercont">
                                <h6>{{$note->name}}</h6>

                                <p>{{$note->message}}</p>
                                <ul>
                                    <li>
                                        <div class="notice_feed_listinnerimg"> {{ HTML::image('assets/images/notice_feed_img2.png')}} </div>
                                        <div class="notice_feed_listinnercont">
                                            <h6>{{getInstitutionName($institution->id)}}</h6>

                                            <p>{{$note->replymessage}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    @endforeach

                </ul>

                <div class="sendyourownnote_info">

                    {{ Form::open(array('id' => 'notesform')) }}

                    {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Institution!']) }}

                    {{ Form::submit('Send Note',['class'=>'submit_feed_button']) }}

                    {{ Form::close() }}


                </div>

            </div>

            <div class="alert alert-success note_message">
                <span></span>
                <a class="close">&times;</a>

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
                                {{   HTML::image(getImage('uploads/profiles/',getUserPicture($note->user_id),'noimage.jpg'))}}

                            </div>

                            <div class="notice_feed_listinnercont">

                                <h6>{{$note->name}}</h6>

                                <p>{{$note->message}}</p>

                                <a href="javascript:void(0);" class="reply_message" id="{{$note->id}}">reply</a>

                                <div class="sendyourownnote_info institution_reply form_{{$note->id}} ">

                                    {{ Form::open(array('id' => 'notesreplyform')) }}

                                    <div class="note_field">

                                        {{ Form::text('notes', null, ['required'=>'required','id'=>'notes','placeholder' => 'Send your own note to the Institution!']) }}

                                        {{Form::hidden('note_id',$note->id,['id'=>'note_id'])}}
                                    </div>

                                    <div class="note_controls">

                                        {{ Form::submit('Reply',['class'=>'institution_reply_button submit_reply_button', 'id'=>$note->id]) }}

                                        {{ Form::button('Cancel',['class'=>'institution_reply_button cancel_message', 'id'=>$note->id]) }}

                                    </div>
                                    {{ Form::close() }}

                                </div>

                            </div>

                        </li>


                    @endforeach

                </ul>

                <div class="editsettings_btn"><a href="{{URL::route('get_inst_feedback',$institution->slug)}}">view all
                        notes / feedback</a></div>
            </div>


            <div class="alert alert-success note_message">
                <span></span>
                <a class="close">&times;</a>

            </div>

        </div>

    @endif

@endif