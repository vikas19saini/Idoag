
<div class="form-group">
<?php $type_ij = getPostType($internship->id);?>

    {{ Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        <select name='internship' class='form-control' required='true'>
            @if($type_ij == 'job')
                <option value='job' selected='true'>Job</option>
                <option value='internship'>Internship</option>
                <option value='ambassador'>Ambassador</option>
            @elseif($type_ij == 'internship')
                <option value='job'>Job</option>
                <option value='internship' selected='true'>Internship</option>
                <option value='ambassador'>Ambassador</option>
            @elseif($type_ij == 'ambassador')
                <option value='job'>Job</option>
                <option value='internship'>Internship</option>
                <option value='ambassador' selected='true'>Ambassador</option>
            @else                
                <option value='job'>Job</option>
                <option value='internship'>Internship</option>
                <option value='ambassador'>Ambassador</option>
            @endif
        </select>        
    </div>

</div>

<div class="form-group">

    {{ Form::label('brand', 'Brand', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::select('brand_id',array('' => '-- Please select Brand --') + $brands,
        null,['class' => 'form-control', 'id' => 'brandid', 'required' => 'required'] ) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('internship_title', 'Internship/Job Title', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control','required']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>
<div class="form-group">

    {{ Form::label('category', 'Category', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{Form::select('category',['' => 'Select Category']+ $categories,null,['class'=>'form-control','required'])}}

        {{ errors_for('category', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('skills', 'Skills', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('skills', null, ['placeholder' => 'Skills', 'class' => 'form-control']) }}

        {{ errors_for('skills', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control textarea', 'id' => 'description','required']) }}

        {{ errors_for('description', $errors) }}

    </div>

</div>
<div class="form-group">

    {{ Form::label('application_date', 'Application End Date', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('application_date', null, ['placeholder' => 'Application End Date', 'class' => 'form-control','required', 'id' => 'application_date']) }}

        {{ errors_for('application_date', $errors) }}

    </div>

</div>

<div class="form-group">
    {{ Form::label('nam_val', 'Internship/Job Start Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('start_date', null, ['placeholder' => 'Start Date', 'class' => 'form-control', 'id'=>'start_date']) }}
    </div>
    {{ Form::label('nam_val', 'Internship/Job End Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('end_date', null, ['placeholder' => 'End Date', 'class' => 'form-control', 'id'=>'end_date']) }}
    </div>

</div>

<div class="form-group">

    {{ Form::label('image', 'Internship/Job Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('image', null, ['class' => 'form-control', 'id' => 'image']) }}

        {{ errors_for('image', $errors) }}

    </div>


    <div class="col-sm-5">

        {{ HTML::image((isset($internship))?'uploads/photos/'.$internship->image:'assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'image_preview']) }}
    </div>

</div>

@if(isset($internship))
    <div class="form-group">
        {{ Form::label('city', 'Location', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
            {{Form::text('city',null ,['class'=>'form-control','max'=> 255])}}

        </div>
    </div>
@else   

    <div class="form-group">
        {{ Form::label('city', 'Location', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{Form::text('city', null, ['class'=>'form-control', 'max' =>255])}}

        </div>
    </div>
@endif

<div class="form-group">
    {{ Form::label('offer_type', 'Internship/Job Type', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{Form::select('offer_type',['' => 'Select Internship Type']+ $internship_types,null,['class'=>'form-control','required'])}}
        {{ errors_for('offer_type', $errors) }}

    </div>
</div>

<div class="form-group">
    {{ Form::label('resume_preference', 'Resume Preferences', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{Form::select('resume_preference',['' => 'Select Resume Preferences']+ $resume_preferences,null,['class'=>'form-control','required'])}}
        {{ errors_for('resume_preference', $errors) }}

    </div>
</div>
<div class="form-group">
    {{ Form::label('amount', 'Stipend/Salary', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('amount', null, ['placeholder' => 'Stipend Amount', 'class' => 'form-control', 'id'=>'offer_value']) }}
        {{ errors_for('amount', $errors) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('positions', 'No. of Positions', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('positions', null, ['placeholder' => 'No. of Positions', 'class' => 'form-control', 'id'=>'offer_value']) }}
        {{ errors_for('positions', $errors) }}
    </div>
</div>

@for($i=1;$i<=5;$i++)

    <div class="form-group">
        {{ Form::label('question'.$i, 'Question '.$i, ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            {{ Form::text('question'.$i, null, ['placeholder' => 'Question '.$i, 'class' => 'form-control', 'id'=>'offer_value']) }}
        </div>
    </div>
@endfor
<div class="form-group" align="center">
Note: Leave Questions blank if not required.
</div>