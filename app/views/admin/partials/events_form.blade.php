{{ Form::hidden('event', 'event') }}

<div class="form-group">

    {{ Form::label('brand_id', 'Brand', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::select('brand_id',['' => 'Please select Brand'] + $brands, null,['class' => 'form-control', 'id' => 'brandid', 'required' => 'required'] ) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('size', 'Size', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">

        {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}

        {{ errors_for('size', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('name', 'Event Title', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>


<div class="form-group">
    {{ Form::label('nam_val', 'Event Start Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('start_date', null, ['placeholder' => 'Start Date', 'class' => 'form-control', 'id'=>'start_date']) }}
        {{ errors_for('start_date', $errors) }}
    </div>
    {{ Form::label('nam_val', 'Event End Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('end_date', null, ['placeholder' => 'End Date', 'class' => 'form-control', 'id'=>'end_date']) }}
        {{ errors_for('end_date', $errors) }}
    </div>
</div>
<div>
    <div class="col-sm-1"></div>
     <div class="col-sm-5">
        <div class="bootstrap-timepicker">
            <div class="form-group">
                {{ Form::label('nam_val', 'Start Time', ['class' => 'col-sm-5 control-label']) }}
                <div class="col-sm-3">
                <div class="input_val tabs">
                    <div class="input-group" style="width:160px;">
                        <input id="time_from" class="timepicker form-control" name="time_from" type="text">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div></div>
                </div><!-- /.input group -->
                    </div>
            </div><!-- /.form group -->
        </div>
         </div>

<div class="col-sm-6">
    <div class="bootstrap-timepicker">
        <div class="form-group">
            {{ Form::label('nam_val', 'End Time', ['class' => 'col-sm-4 control-label']) }}
            <div class="col-sm-3">
                <div class="input_val tabs">
                    <div class="input-group" style="width:160px;">
                        <input id="time_from" class="timepicker form-control" name="time_to" type="text">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div></div>
                </div><!-- /.input group -->
            </div>
        </div><!-- /.form group -->
    </div>
</div>


</div>


<div class="form-group">

    {{ Form::label('image', 'Event Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('image', null, [ 'class' => 'form-control', 'id' => 'image']) }}

        {{ errors_for('image', $errors) }}

    </div>


    <div class="col-sm-5">
        {{ HTML::image((isset($event))?'uploads/photos/'.$event->image:'assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}

     </div>

</div>

@if(isset($event))
    <div class="form-group">
        {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{ Form::select(
            'state',
            array('' => '-- Please select State --')  + $states,  $event->state,
            ['class' => 'form-control', 'id' => 'stateId',  'onchange' => 'getCity(this.value)']
            )
            }}

            {{ errors_for('state', $errors) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
            {{Form::select('city',array('' => 'Select City')+$cities,$event->city,['class'=>'form-control','id'=>'cityId'])}}

        </div>
    </div>
@else
    <div class="form-group">
        {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{ Form::select('state', array('' => 'Select State') + $states,  null,  ['class' => 'form-control', 'id' => 'stateId',  'onchange' => 'getCity(this.value)'])}}
            {{ errors_for('state', $errors) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{Form::select('city',array('' => 'Select City'),null,['class'=>'form-control','id'=>'cityId'])}}

        </div>
    </div>
@endif
<div class="form-group">

    {{ Form::label('isfree', 'Is Free?', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::checkbox('isfree', 1, null,  ['id' => 'isfree'] ) }}

    </div>

</div>

<div class="form-group">
    {{ Form::label('registration_url', 'Registration Link', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::text('registration_url', null, ['placeholder' => 'Registration Link', 'class' => 'form-control', 'id'=>'offer_value']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('contact_details', 'Contact Details ', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{ Form::textarea('contact_details', null, ['placeholder' => 'Contact Details ', 'class' => 'form-control', 'id'=>'offer_value']) }}
    </div>
</div>


<div class="form-group">

    {{ Form::label('short_description', 'Short Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control', 'id' => 'description']) }}

        {{ errors_for('short_description', $errors) }}

    </div>

</div>


<div class="form-group">

    {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control textarea', 'id' => 'description']) }}

        {{ errors_for('description', $errors) }}

    </div>

</div>

