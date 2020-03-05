{{ Form::hidden('post_id', $post->id) }}

<div class="input_val">

    {{ Form::text('name', $loggedin_user->first_name.' '.$loggedin_user->last_name, ['placeholder' => 'Name', 'id'=>'name','required']) }}

    {{ errors_for('name', $errors) }}
</div>

<div class="input_val">
    {{ Form::text('institution', getInstitutionName($student->institution_id), ['placeholder' => 'Institution', 'id'=>'institution','required']) }}

    {{ errors_for('institution', $errors) }}
</div>

<div class="input_val">
    {{ Form::text('course', $student->course, ['placeholder' => 'Course/Degree', 'id'=>'course','required']) }}

    {{ errors_for('course', $errors) }}
</div>

<div class="input_val">
    {{ Form::textarea('cover_letter', $student->cover_letter, ['placeholder' => 'Cover Letter', 'id'=>'cover_letetr', 'rows'=>'4','required']) }}

    {{ errors_for('cover_letter', $errors) }}
</div>

<div class="input_val">
    {{ Form::textarea('why_selected', $student->why_selected, ['placeholder' => 'Why you should be selected?', 'rows'=>'4','id'=>'why_selected']) }}

    {{ errors_for('why_selected', $errors) }}
</div>

<h4 class="subhead">Education</h4>

    <div class="input_val">
        {{ Form::text('edu_degree_type', null, ['placeholder' => 'Degree Type','required']) }}

        {{ errors_for('edu_degree_type', $errors) }}

    </div>

    <div class="input_val">
        {{ Form::text('edu_college', null, ['placeholder' => 'College Name','required']) }}

        {{ errors_for('edu_college', $errors) }}
    </div>

    <div class="input_val">
        {{ Form::text('edu_course', null, ['placeholder' => 'Course Name','required']) }}

        {{ errors_for('edu_course', $errors) }}   
    </div>

    <div class="input_val">
        {{ Form::text('edu_year', null, ['placeholder' => 'Passed out Year','required']) }}

        {{ errors_for('edu_year', $errors) }}
    </div>

<h4 class="subhead">Experience / Relavent Skills</h4>

    <div class="input_val">
        {{ Form::text('exp_title', null, ['placeholder' => 'Title']) }}

        {{ errors_for('exp_title', $errors) }}
    </div>

    <div class="input_val">
        {{ Form::textarea('exp_info', $student->exp_info, ['placeholder' => 'Work Details', 'rows'=>'4','id'=>'exp_info']) }}

        {{ errors_for('exp_info', $errors) }}
    </div>

    <div class="input_val">
        {{ Form::text('exp_duration', null, ['placeholder' => 'Duration']) }}

        {{ errors_for('exp_duration', $errors) }}  
    </div>

    <div class="input_val">
        {{ Form::text('exp_year', null, ['placeholder' => 'Worked Till']) }}

        {{ errors_for('exp_year', $errors) }}  
    </div>

<h4 class="subhead">Brand Questions:</h4>

    @if($post->question1!='')
        {{ Form::label('answer1', $post->question1, array('class' => 'nam_val')) }}

        <div class="input_val">
            {{ Form::textarea('answer1',null, ['placeholder' => '','required','rows'=>2]) }}

            {{ errors_for('answer1', $errors) }}
        </div>

    @endif

    @if($post->question2!='')

        {{ Form::label('answer2', $post->question2, array('class' => 'nam_val')) }}

        <div class="input_val">
            {{ Form::textarea('answer2',null, ['placeholder' => '','required','rows'=>2]) }}

            {{ errors_for('answer2', $errors) }}
        </div>

    @endif

    @if($post->question3!='')

        {{ Form::label('answer3', $post->question3, array('class' => 'nam_val')) }}

        <div class="input_val">
            {{ Form::textarea('answer3',null, ['placeholder' => '','required','rows'=>2]) }}

            {{ errors_for('answer3', $errors) }}
        </div>

    @endif

    @if($post->question4!='')

        {{ Form::label('answer4', $post->question4, array('class' => 'nam_val')) }}

        <div class="input_val">
            {{ Form::textarea('answer4',null, ['placeholder' => '','required','rows'=>2]) }}

            {{ errors_for('answer4', $errors) }}
        </div>

    @endif

    @if($post->question5!='')

        {{ Form::label('answer5', $post->question5, array('class' => 'nam_val')) }}

        <div class="input_val">
            {{ Form::textarea('answer5',null, ['placeholder' => '','required','rows'=>2]) }}

            {{ errors_for('answer5', $errors) }}
        </div>
    @endif

@if($post->resume_preference=='Video Resume')
    {{ Form::label('video_resume', 'Video Resume', array('class' => 'nam_val')) }}
    <div class="input_val">
        {{ Form::text('video_resume', null, ['placeholder' => 'Video URL','required']) }}
        {{ errors_for('video_resume', $errors) }}
    </div>
    {{ Form::label('resume', 'Resume', array('class' => 'nam_val')) }}

    <div class="input_val checkbox_space">
        {{Form::file('resume',['placeholder' => 'Document','class' => 'offer_image','accept'=>'.pdf,.doc, .docx'])}}

        {{ errors_for('file', $errors ) }}
    </div>
    @else
    {{ Form::label('resume', 'Resume', array('class' => 'nam_val')) }}
    <div class="input_val checkbox_space">
        {{Form::file('resume',['placeholder' => 'Document','required', 'class' => 'offer_image','accept'=>'.pdf,.doc, .docx'])}}

        {{ errors_for('file', $errors ) }}
    </div>
@endif

<div class="input_val">
    <div class="g-recaptcha" id="captchaContainer" data-theme="light" data-sitekey="6LdjgRgTAAAAAMp-Ztydlt8NpmG3761HKYeKxLT6" style="transform:scale(1.06);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
</div>
<div class="input_val checkbox_space">
    {{ Form::checkbox('terms_and_conditions', 1, null, ['class' => 'field', 'required'=>'required']) }}

    {{ errors_for('terms_and_conditions', $errors) }}Check to agree our terms and conditions
</div>
