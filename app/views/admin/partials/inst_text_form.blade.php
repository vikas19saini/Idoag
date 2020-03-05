{{ Form::hidden('instext', 'instext') }}

<div class="form-group">

    {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::select('institution_id',array('' => '-- Please select Institution --') + $institutions,
        'null' ,['class' => 'form-control', 'id' => 'institutionid', 'required' => 'required'] ) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('title', 'Link Title', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('description', 'Short Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}

        {{ errors_for('description', $errors) }}

    </div>

</div>