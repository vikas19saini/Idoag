<div class="form-group">

    {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

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

    {{ Form::label('src', 'Link', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('src', null, ['placeholder' => 'Link', 'class' => 'form-control']) }}

        {{ errors_for('src', $errors) }}

    </div>

</div>
