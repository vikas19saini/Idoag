<div class="form-group">

    {{ Form::label('company_name', 'Company Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('company_name', null, ['placeholder' => 'Company Name', 'class' => 'form-control']) }}

        {{ errors_for('company_name', $errors) }}

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

    {{ Form::label('designation', 'Designation', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('designation', null, ['placeholder' => 'Designation', 'class' => 'form-control']) }}

        {{ errors_for('designation', $errors) }}

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