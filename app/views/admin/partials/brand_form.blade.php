<div class="form-group">

    {{ Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}

        {{ errors_for('name', $errors) }}

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

    {{ Form::label('category', 'Category', ['class' => 'col-sm-3 control-label admin_select']) }}

    <div class="col-sm-8">
        @if(isset($brand))
            <select id="category" name="category[]" multiple="multiple" class="form-control" required = "required">
                <?php $brand_categories = explode(",", $brand->category); ?>

                @foreach($categories as $key => $category)

                    @if(in_array($key, $brand_categories))

                        <option value="{{ $key }}" selected="selected">{{ $category }}</option>
                    @else

                        <option value="{{ $key }}">{{ $category }}</option>
                    @endif

                @endforeach

            </select>
        @else
        {{ Form::select('category[]', $categories, '' , ['class' => 'form-control', 'id' => 'category', 'multiple' => 'multiple', 'required' => 'required']) }}
        @endif
        {{ errors_for('category', $errors) }}

    </div>

</div>
@if(isset($brand))
<div class="form-group">

    {{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}

        {{ errors_for('image', $errors) }}

    </div>

    <div class="col-sm-5">

        {{ HTML::image('uploads/brands/'.$brand->image, '', ['class' => 'slider-img', 'id' => 'brand_image_preview']) }}
    </div>

</div>
<div class="form-group">

    {{ Form::label('coverimage', 'Cover Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('coverimage', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image']) }}

        {{ errors_for('coverimage', $errors) }}

    </div>

    <div class="col-sm-5">

        {{ HTML::image('uploads/brands/'.$brand->coverimage, '', ['class' => 'slider-img', 'id' => 'brand_cover_image_preview']) }}
    </div>

</div>
@else
    <div class="form-group">

        {{ Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-4">

            {{ Form::file('image', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image', 'required' => 'required']) }}

            {{ errors_for('image', $errors) }}

        </div>

        <div class="col-sm-5">

            {{ HTML::image('assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'brand_image_preview']) }}
        </div>

    </div>
    <div class="form-group">

        {{ Form::label('coverimage', 'Cover Image', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-4">

            {{ Form::file('coverimage', null, ['required' => 'required', 'class' => 'form-control', 'id' => 'image']) }}

            {{ errors_for('coverimage', $errors) }}

        </div>

        <div class="col-sm-5">

            {{ HTML::image('assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'brand_cover_image_preview']) }}
        </div>

    </div>
    @endif

<div class="form-group">

    {{ Form::label('priority', 'Priority', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::number('priority', null, ['class' => 'form-control', 'id' => 'priority', 'min' => 0]) }}

        {{ errors_for('priority', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('panindia', 'Local Brands', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::select('panindia', $local_brands, '' , ['class' => 'form-control', 'required' => 'required','onchange' => 'checkLocal(this.value)']) }}

        {{ errors_for('panindia', $errors) }}

    </div>

</div>

<div id="Institution" @if(isset($brand) && $brand->panindia == 'College') class="" @else class="hide" @endif>
    <div class="form-group">
        {{ Form::label('institution_id', 'Institution', ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            {{ Form::select('institution_id', $institutions, '' , ['class' => 'form-control']) }}

            {{ errors_for('institution_id', $errors) }}
        </div>
    </div>
</div>

<div id="StateCity" @if(isset($brand) && $brand->panindia == 'Local') class="" @else class="hide" @endif>
@if(isset($brand))
    <div class="form-group">
        {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">

            {{ Form::select(
            'state',
            array('' => '-- Please select State --')  + $states,  $brand->state,
            ['class' => 'form-control', 'id' => 'stateId', 'onchange' => 'getCity(this.value)']
            )
            }}

        </div>
    </div>

    <div class="form-group">
        {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
            {{Form::select('city',array('' => 'Select City')+$cities,$brand->city,['class'=>'form-control','id'=>'cityId'])}}

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

</div>
@if(isset($brand))
 <div class="form-group">
       {{ Form::label('color1', 'Dominant Color', ['class' => 'col-sm-3 control-label']) }} 

        <div class="col-sm-8">
		 <div class="input-group my-colorpicker1" style="max-width:480px;">
                                    {{ Form::text('color1', null, ['class' => 'form-control']) }}<div class="input-group-addon">
                                        <i></i>
                                    </div> 

        </div></div></div>
 	 <div class="form-group">
      {{ Form::label('color2', 'Secondary Color', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
		 <div class="input-group my-colorpicker2" style="max-width:480px;">
                                    {{ Form::text('color2', null, ['class' => 'form-control']) }}
									<div class="input-group-addon">
                                        <i></i>
                                    </div>
 
    </div></div>
	</div> 
	@endif