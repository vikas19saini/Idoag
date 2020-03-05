{{ Form::hidden('offer', 'offer') }}

<div class="form-group">

    {{ Form::label('brand_id', 'Brand', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">

        {{ Form::select('brand_id',array('' => '-- Please select Brand --') + $brands, null,
        ['class' => 'form-control', 'id' => 'brandid', 'required' => 'required'] ) }}
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

    {{ Form::label('for_user_type', 'Users Type', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{Form::select('for_user_type',['commaon' => 'For Everyone', 'students' => 'For Students', 'corporates' => 'For Corporates'],null,['class'=>'form-control','required'])}}

        {{ errors_for('for_user_type', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('name', 'Offer Title', ['class' => 'col-sm-3 control-label']) }}

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
    {{ Form::label('nam_val', 'Offer Start Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('start_date', null, ['placeholder' => 'Start Date', 'class' => 'form-control', 'id'=>'start_date']) }}
    </div>
    {{ Form::label('nam_val', 'Offer End Date', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-2">
        {{ Form::text('end_date', null, ['placeholder' => 'End Date', 'class' => 'form-control', 'id'=>'end_date']) }}
    </div>
</div>

<div class="form-group">

    {{ Form::label('web_only', 'Web Only?', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-8">

        {{ Form::checkbox('web_only', 1, null,  ['id' => 'webonly'] ) }} &nbsp;
        <span> Check to show a Web Only Banner with the Offer </span>
        {{ errors_for('web_only', $errors) }}

    </div>

</div>

<div class="form-group">

    {{ Form::label('offer_image', 'Offer Image', ['class' => 'col-sm-3 control-label']) }}

    <div class="col-sm-4">

        {{ Form::file('offer_image', [   'id' => 'image']) }}

        {{ errors_for('offer_image', $errors) }}

    </div>


    <div class="col-sm-5">

        {{ HTML::image((isset($offer))?'uploads/photos/'.$offer->image:'assets/images/banner_img.jpg', '', ['class' => 'slider-img', 'id' => 'offer_image_preview']) }}
    </div>

</div>


    <div class="form-group">
    
        {{ Form::label('Featured', 'Featured', ['class' => 'col-sm-3 control-label']) }}

        <div class="col-sm-8">
            
            {{ Form::checkbox('featured', 1, null) }}
            
            {{ errors_for('featured', $errors) }}
            
        </div>
        
    </div>
                                            

<div class="form-group">
    {{ Form::label('offer_type', 'Offer Type', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{Form::select('offer_type',['' => 'Select Offer Type','percentage'=>'Percentage','flat'=>'Flat'],null,['class'=>'form-control','required',  'onchange' => 'checkType(this.value)'])}}

    </div>
</div>
<?php if(isset($offer))
    $offer_value=$offer->offer_value;
        else
            $offer_value="";
    ?>
    <div class="form-group">
    {{ Form::label('offer_value', 'Offer Value', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        <div id="OfferType1" @if(isset($offer) && $offer->offer_type == 'percentage') class="" @else class="hide" @endif>
        {{Form::selectRange('offer_value1', 1, 99, $offer_value, ['class'=>'form-control'])}}
            </div>
        <div id="OfferType2" @if(isset($offer) && $offer->offer_type == 'flat') class="" @else class="hide" @endif>
            {{ Form::text('offer_value2', $offer_value, ['placeholder' => 'Offer Value', 'class' => 'form-control']) }}
        </div>
     </div>
</div>
<div class="form-group">
    {{ Form::label('voucher_type', 'Voucher Type', ['class' => 'col-sm-3 control-label']) }}
    <div class="col-sm-8">
        {{Form::select('voucher_type',['' => 'Select Voucher Type','no_coupon'=>'No Coupon','single'=>'Single','multiple'=>'Multiple'],null,['class'=>'form-control','id'=>'voucher_type','required', 'onchange' => 'getVoucher(this.value)'])}}

    </div>
</div>

<div id="VoucherSingle" @if(isset($offer) && $offer->voucher_type == 'single') class="" @else class="hide" @endif>
    <div class="form-group">
        {{ Form::label('coupon_code', 'Enter Coupon Code', ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            {{Form::text('coupon_code',(isset($offer) && $offer->voucher_type == 'single')?$coupon->code:null,['id' => 'coupon_code', 'class' => 'form-control'])}}
        </div>
    </div>
</div>
<div id="VoucherMultiple" @if(isset($offer) && $offer->voucher_type == 'multiple') class="" @else class="hide" @endif>
    <div class="form-group">
        {{ Form::label('coupon_codes', 'Attach Coupon Codes', ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            {{Form::file('coupon_codes',['placeholder' => 'Excel',  'class' => 'offer_image','accept'=>'.xls,.xlsx, .csv'])}}
            <br><a href="{{ URL::route('sample_coupons') }}" class="btn btn-info"><i class="fa fa-download"></i> Sample Excel</a>
        </div> </div></div>

<div id="panindia" @if(isset($offer) && $offer->web_only == 1) style="display:none"@endif>
    <div class="form-group">
        {{ Form::label('panindia', 'Pan India', ['class' => 'col-sm-3 control-label']) }}
        <div class="col-sm-8">
            {{Form::select('panindia',$local_brands,null,['class'=>'form-control','onchange' => 'checkLocal(this.value)'])}}

        </div>
    </div>

    <div id="Institution" @if(isset($offer) && $offer->panindia == 'College') class="" @else class="hide" @endif>
        <div class="form-group">
            {{ Form::label('panindia_inst_id', 'Institution', ['class' => 'col-sm-3 control-label']) }}
            <div class="col-sm-8">
                {{ Form::select('panindia_inst_id', $institutions, null , ['class' => 'form-control']) }}
            </div>
        </div>
    </div>

    <div id="StateCity" @if(isset($offer) && ($offer->panindia == 'Local' ||$offer->panindia == null )) class="" @else class="hide" @endif>
        @if(isset($offer))
            <div class="form-group">
                {{ Form::label('state', 'State', ['class' => 'col-sm-3 control-label']) }}

                <div class="col-sm-8">

                    {{ Form::select(
                    'state',
                    array('' => '-- Please select State --')  + $states,  $offer->state,
                    ['class' => 'form-control', 'id' => 'stateId',  'onchange' => 'getCity(this.value)']
                    )
                    }}

                </div>
            </div>

            <div class="form-group">
                {{ Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) }}

                <div class="col-sm-8">
                    {{Form::select('city',array('' => 'Select City')+$cities,$offer->city,['class'=>'form-control','id'=>'cityId'])}}

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

                    {{Form::select('city',array('' => 'Select City'),null,['class'=>'form-control','id'=>'cityId'])}}

                </div>
            </div>
        @endif
        </div>

    </div>
