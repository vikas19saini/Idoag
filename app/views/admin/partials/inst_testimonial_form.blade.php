<div class="form-group">

    {{ Form::label('institute_name', 'Institute Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('institute_name', null, ['placeholder' => 'Institute Name', 'class' => 'form-control']) }}

        {{ errors_for('institute_name', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>
<div class="form-group">

    {{ Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
        {{ errors_for('email', $errors) }}


    </div>

</div>
<div class="form-group">

    {{ Form::label('study', 'Study', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('study', null, ['placeholder' => 'Study', 'class' => 'form-control']) }}

        {{ errors_for('study', $errors) }}

    </div>

</div>
<div class="form-group">

    {{ Form::label('image', 'Picture', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::file('image', null, ['class' => 'form-control', 'id' => 'logo']) }}

        {{ errors_for('image', $errors) }}

    </div>

</div>
<div class="form-group">

    {{ Form::label('description', null, ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('description', null, ['placeholder' => 'Answer', 'class' => 'form-control', 'id' => 'description']) }}

        {{ errors_for('description', $errors) }}

    </div>

</div>