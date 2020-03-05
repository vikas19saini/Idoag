<input type="hidden" name="insphoto" value="insphoto" />

<ul>
    <li>
        <div class="nam_val">Size</div>
        <div class="input_val">
            {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}   </div>

    </li>
    <li>
        <div class="nam_val">Photo Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder'=>'Photo Name','class' => 'form-control'])}}
            {{ errors_for('name', $errors) }}
        </div>
    </li>
    <li>
        <div class="nam_val">Short Description</div>
        <div class="input_val">
            {{Form::textarea('short_description',null,['placeholder'=>'Short Description','class' => 'form-control','rows'=>3])}}
            {{ errors_for('short_description', $errors) }}
        </div>
    </li>
    <li>
        <div class="nam_val">Description</div>
        <div>
            {{Form::textarea('description',null,['placeholder'=>'Description','id'=>'description', 'class'=>'textarea form-control'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">{{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}</div>
        <div class="col-sm-4">

            {{ Form::file('image', null, [ 'class' => 'form-control', 'id' => 'image','required'=>'required']) }}

            {{ errors_for('image', $errors) }}

        </div>
        <div class="col-sm-5">
            @if(isset($photo))
                {{ HTML::image('/uploads/photos/'.$photo->image, '', ['class' => 'slider-img', 'id' => 'photo_image_preview','style'=>'max-height:200px; max-width:200px']) }}
            @else
                {{ HTML::image('/uploads/photos/', '', ['class' => 'slider-img', 'id' => 'photo_image_preview','style'=>'max-height:200px; max-width:200px']) }}
            @endif

        </div>

    </li>
 
</ul>