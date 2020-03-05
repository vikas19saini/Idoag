<input type="hidden" name="photo" value="photo" />

<ul>
    <li>
        <div class="nam_val">Size</div>
        <div class="input_val">
            {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required', 'onchange'=>'checksize(this.value)'])}}   </div>

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
        <div class="textarea_val">
            {{Form::textarea('description',null,['required','class'=>'form-control largetextarea textarea'])}}
            {{ errors_for('description', $errors) }}
        </div>
    </li>
    <li>
        <div class="nam_val">Image</div>
        <div class="input_val row">
        <div class="col-sm-4">
		 @if(isset($photo))
            {{ Form::file('image',  [ 'placeholder' => 'Image', 'class' => 'offer_image', 'id' => 'image']) }}
		 @else
            {{ Form::file('image',  [ 'placeholder' => 'Image', 'class' => 'offer_image', 'id' => 'image', 'required'=>'required']) }}
		 @endif
            {{ errors_for('image', $errors) }}
            <div class="displaysize"> </div>
        </div>
        <div class="col-sm-8">
            @if(isset($photo))
                {{ HTML::image('/uploads/photos/'.$photo->image, '', ['class' => 'slider-img', 'id' => 'photo_image_preview','style'=>'max-height:200px; max-width:200px']) }}
            @else
                {{ HTML::image('', '', ['class' => 'slider-img', 'id' => 'photo_image_preview','style'=>'max-height:200px; max-width:200px']) }}
            @endif

        </div>
        </div>

    </li>
   
</ul>