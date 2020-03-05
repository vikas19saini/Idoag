{{ Form::hidden('photo', 'photo') }}
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

    {{ Form::label('photo', 'Photo Title', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('short_description', 'Short Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('short_description', null, ['placeholder' => 'Short Description', 'class' => 'form-control', 'rows'=>3]) }}

        {{ errors_for('short_description', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'id' => 'description']) }}

        {{ errors_for('description', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('image', null, ['class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}

        {{ errors_for('image', $errors) }}

    </div>


    <div class="col-sm-5">

        {{ HTML::image((isset($photo))?'uploads/photos/'.$photo->image:'assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'photo_image_preview']) }}
    </div>

</div>