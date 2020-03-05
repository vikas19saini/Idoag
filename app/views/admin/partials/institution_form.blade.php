<div class="form-group">

    {{ Form::label('id', 'ID', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('id', null, ['placeholder' => 'Enter Institution ID', 'class' => 'form-control']) }}

        {{ errors_for('id', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Enter Institution Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>

<div class="form-group">
    {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::textarea('description', null, ['placeholder' => 'Description about institution', 'class' => 'form-control', 'id' => 'description']) }}
        {{ errors_for('description', $errors) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::select('type', ['institution' => 'College/University', 'company' => 'Company'], null, ['class' => 'form-control']) }}
        {{ errors_for('type', $errors) }}
    </div>
</div>


<div class="form-group">

    {{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}

        {{ errors_for('image', $errors) }}

    </div>

    <div class="col-sm-5">

        {{ HTML::image('assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'institution_image_preview']) }}
    </div>

</div>

<div class="form-group">

    {{ Form::label('priority', 'Priority', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::number('priority', null, ['class' => 'form-control', 'id' => 'priority', 'min' => 0]) }}

        {{ errors_for('priority', $errors) }}

    </div>

</div>

@if(isset($institution))
    <div class="form-group">
        {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{ Form::select(
            'state',
            array('' => '-- Please select State --')  + $states,  $institution->state,
            ['class' => 'form-control', 'id' => 'stateId', 'onchange' => 'getCity(this.value)']
            )
            }}

        </div>
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
            {{Form::select('city',array('' => 'Select City')+$cities,$institution->city,['class'=>'form-control','id'=>'cityId'])}}

        </div>
    </div>

@else
    <div class="form-group">
        {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{ Form::select('state', array('' => 'Select State') + $states,  null,  ['class' => 'form-control', 'id' => 'stateId',  'onchange' => 'getCity(this.value)'])}}

        </div>
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{Form::select('city',array('' => 'Select City'),null,['class'=>'form-control','id'=>'cityId' ])}}

        </div>
    </div>
@endif