<input type="hidden" name="offer" value="offer" />

<ul>
    <li>
        <div class="nam_val">Size</div>
        <div class="input_val">
            {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required', 'onchange'=>'checksize(this.value)'])}}   </div>
    </li>
    <li>
        <div class="nam_val">Offer Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder' => 'Title', 'class' => 'form-control', 'required' => 'required'])}}
        </div>
    </li>

    <li class="date_txt">
        <div class="row clearfix">
            <div class="col-sm-6 date_clear">
                <div class="nam_val">Offer Start Date</div>
                <div class="input_val tabs">
                    {{Form::text('start_date',null,['id' => 'start_date', 'class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-sm-6 date_clear">
                <div class="nam_val">Offer End Date</div>
                <div class="input_val tabs">
                    {{Form::text('end_date',null,['id' => 'end_date', 'class' => 'form-control'])}}
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="nam_val">Offer Image</div>
        
        <div class="input_val">

            {{Form::file('offer_image',['placeholder' => 'Image', 'id' => 'image','class' => 'offer_image','accept'=>'.jpg,.png'])}}

            @if(isset($offer))
                <img class="preview_offer" src="/uploads/photos/{{$offer->image}}"  style="max-height:200px; max-width:200px;"/>
            @else
                <img class="preview_offer"  style="max-height:200px; max-width:200px;"/>
            @endif
            <div class="displaysize"> </div>
        </div>
    </li>
    <li>
        <div class="nam_val">Web Only?</div>
        <div class="input_val">
            {{ Form::checkbox('web_only', '1',null, ['id' => 'webonly'] )}}
            Check to show a Web Only Banner with the Offer </div>
    </li>


    <li>
        <div class="nam_val">Offer Type</div>
        <div class="input_val">
            {{Form::select('offer_type',['' => 'Select Offer Type','percentage'=>'Percentage','flat'=>'Flat'],null,['class'=>'form-control','required',  'onchange' => 'checkType(this.value)'])}}
        </div>
    </li>

    <li>
        <div class="nam_val">Offer Value</div>
        <div class="input_val">
            @if(isset($offer))
             <?php   $offer_value=$offer->offer_value;?>
            @else
                <?php   $offer_value='';?>
                @endif
            <div id="OfferType1" @if(isset($offer) && $offer->offer_type == 'percentage') class="" @else class="hide" @endif>
                {{Form::selectRange('offer_value1', 1, 99, $offer_value, ['class'=>'form-control',  'id'=>'offer_value1'])}}
            </div>

            <div id="OfferType2" @if(isset($offer) && $offer->offer_type == 'flat') class="" @else class="hide" @endif>
                {{ Form::text('offer_value2', $offer_value, ['placeholder' => 'Offer Value', 'class' => 'form-control', 'id'=>'offer_value2']) }}
            </div>
        </div>
    </li>


    <li>
        <div class="nam_val">Voucher Type</div>
        <div class="input_val">
            {{Form::select('voucher_type',['' => 'Select Voucher Type','no_coupon'=>'No Coupon','single'=>'Single','multiple'=>'Multiple'],null,['class'=>'form-control','id'=>'voucher_type','required', 'onchange' => 'getVoucher(this.value)'])}}
        </div>
    </li>

        <div id="VoucherSingle" class="hide">
            <li>
        <div class="nam_val">Enter Coupon Code</div>
        <div class="input_val">
            @if(isset($offer))
            
            {{Form::text('coupon_code',$coupon_code,['class'=>'form-control','id' => 'coupon_code'])}}
            
            @else
            
            {{Form::text('coupon_code',null,['class'=>'form-control','id' => 'coupon_code'])}}
            
            @endif
        </div>

        </div>
        <div id="VoucherMultiple" class="hide">
            <li> <div class="nam_val">Attach Coupon Codes  </div>
            <div class="input_val">
                {{Form::file('coupon_codes',['placeholder' => 'Excel',  'class' => 'offer_image','accept'=>'.xls,.xlsx, .csv'])}}
                    <div class="choose_msg"></div>

                <br><a href="{{ URL::route('sample_coupons') }}" class="btn btn-info"><i class="fa fa-download"></i> Sample Excel</a>
            </div> 
        </li>
        </div>

    <div id="panindia" @if(isset($offer) && $offer->web_only == 1) class="hide" @else class="" @endif>
    <li>
        <div class="nam_val">Location</div>
        <div class="input_val">
            {{ Form::select('panindia', $local_brands, null , ['class' => 'form-control', 'onchange' => 'checkLocal(this.value)']) }}
        </div>
    </li>

    <div id="Institution" @if(isset($offer) && $offer->panindia == 'College') class="" @else class="hide" @endif>
        <li>
            <div class="nam_val">Institution</div>
            <div class="input_val">
                {{ Form::select('panindia_inst_id',  array('' => 'Select College') + $institutions, null , ['class' => 'form-control']) }}
            </div>
        </li>
    </div>

    <div id="StateCity" @if(isset($offer) && $offer->panindia == 'College') class="hide"  @endif>
        @if(isset($offer))
            <li>
                <div class="nam_val">State</div>

                <div class="input_val">  {{ Form::select('state', array('' => 'Select State') + $states,  $offer->state ,  ['class' => 'form-control', 'id' => 'stateId',  'onchange' => 'getCity(this.value)'])}}
                </div></li>
            <li>
                <div class="nam_val">City</div>
                <div class="input_val">

                    {{Form::select('city',array('' => 'Select City')+$cities,$offer->city,['class'=>'form-control','id'=>'cityId'])}}
                </div>
            </li>
        @else
            <li>
                <div class="nam_val">State</div>
                <div class="input_val">  {{ Form::select('state', array('' => 'Select State') + $states,  'null' ,  ['class' => 'form-control', 'id' => 'stateId','onchange' => 'getCity(this.value)'])}}
                </div>
            </li>

            <li>
                <div class="nam_val">City</div>
                <div class="input_val">

                    {{Form::select('city',array('' => 'Select City'),'null',['class'=>'form-control','id'=>'cityId'])}}
                </div>
            </li>
        @endif
            <div id="AvailableStores">
                <li>
                    <div class="nam_val">Available stores</div>
                    
                    <div class="input_val multiselect-container selectdropdown">
                        @if(count($stores))
                    
                            @if(isset($offer))
                            
                                <select id="store" name="available_stores[]" multiple="multiple" class="form-control" >
                                    
                                    <?php $offer_stores = explode(",", $offer->available_stores); ?>

                                    @foreach($stores as $key => $store)

                                        @if(in_array($key, $offer_stores))

                                            <option value="{{ $key }}" selected="selected">{{ $store }}</option>
                                        @else

                                            <option value="{{ $key }}">{{ $store }}</option>
                                        @endif

                                    @endforeach

                                </select>
                                @else

                                {{ Form::select('available_stores[]', $stores, '' , ['class' => 'form-control', 'id' => 'store', 'multiple' => 'multiple']) }}

                            @endif

                        @else

                        please <a href="{{url::route('create_outlet',array('slug'=>$brand->slug))}}" target="_blank"> click here </a> to add Outlets</p>
                        @endif
                    </div>
                </li>
            </div>
    </div>
    </div>
    <li>
        <div class="nam_val"> Short Description</div>
        <div class="input_val">
            {{Form::textarea('short_description',null,['class'=>'form-control','required','rows'=>3])}}
        </div>
    </li>
    <li><div class="nam_val">Description</div>
        <div class="textarea_val">

        {{Form::textarea('description',null,['required','class'=>'form-control largetextarea textarea'])}}
</div>
    </li>

</ul>