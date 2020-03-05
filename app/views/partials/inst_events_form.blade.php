<input type="hidden" name="insevent" value="insevent" />

<ul>
    <li>
        <div class="nam_val">Size</div>
        <div class="input_val">
            {{Form::select('size',['' => 'Select Size']+ $post_sizes,null,['class'=>'form-control','required'])}}   </div>
    </li>
    <li>
        <div class="nam_val">Event Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder' => 'Title', 'class' => 'form-control', 'required' => 'required'])}}
        </div>
    </li>


    <li class="date_txt">
        <div class="row clearfix">
            <div class="col-sm-6">
                <div class="nam_val">Event Start Date</div>
                <div class="input_val tabs">
                    {{Form::text('start_date',null,['class'=>'form-control','id' => 'start_date'])}}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="nam_val">Event End Date</div>
                <div class="input_val tabs">
                    {{Form::text('end_date',null,['class'=>'form-control','id' => 'end_date'])}}
                </div>
            </div>
        </div>
    </li>
    <li class="date_txt">
        <div class="row clearfix">
            <div class="col-sm-6">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <div class="nam_val">Event Start Time:</div>
                        <div class="input_val tabs">
                        <div class="input-group" style="width:160px;">
                            {{Form::text('time_from',null,['id' => 'time_from', 'class'=>'timepicker form-control'])}}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div></div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>

            </div>
            <div class="col-sm-6">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <div class="nam_val">Event End Time:</div>
                        <div class="input_val tabs">
                            <div class="input-group" style="width:160px;">
                                {{Form::text('time_to',null,['id' => 'time_to', 'class'=>'timepicker form-control'])}}
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div></div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>

            </div>
        </div>
    </li>
    <li>
        <div class="nam_val">Event Image</div>
        <div class="input_val">
            {{Form::file('event_image',['placeholder' => 'Image', 'class' => 'event_image','accept'=>'.jpg,.png'])}}
            @if(isset($event))
            <img class="preview_event" src="/uploads/photos/{{$event->image}}"  style="max-height:200px; max-width:200px;"/>
                @else
                <img class="preview_event"  style="max-height:200px; max-width:200px;"/>
            @endif
        </div>
    </li>
    <li>
        <div class="nam_val">Is Free?</div>
        <div class="input_val">
             {{ Form::select('isfree', [null=>'Please Select'] + array('0' => 'No', '1' => 'Yes'), null, array('class' => 'form-control')) }}
             </div>
    </li>

    @if(isset($event))
        <li>
            <div class="nam_val">State</div>

            <div class="input_val">  {{ Form::select('state', array('' => 'Select State') + $states,  $event->state ,  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)'])}}
            </div></li>
        <li>
            <div class="nam_val">City</div>
            <div class="input_val">

                {{Form::select('city',array('' => 'Select City')+$cities,$event->city,['class'=>'form-control','id'=>'cityId','required'])}}
            </div>
        </li>

    @else
        <li>
            <div class="nam_val">State</div>
            <div class="input_val">  {{ Form::select('state', array('' => 'Select State') + $states,  'null' ,  ['class' => 'form-control', 'id' => 'stateId', 'required' => 'required','onchange' => 'getCity(this.value)'])}}
            </div>
        </li>

        <li>
            <div class="nam_val">City</div>
            <div class="input_val">

                {{Form::select('city',array('' => 'Select City'),'null',['class'=>'form-control','id'=>'cityId','required'])}}
            </div>
        </li>
    @endif

    <li>
        <div class="nam_val">Registration Link </div>
        <div class="input_val">
            {{Form::text('registration_url',null,['class'=>'form-control','id' => 'offer_value'])}}
        </div>
    </li>

    <li>
        <div class="nam_val">Contact Details </div>
        <div class="input_val">
            {{Form::textarea('contact_details',null,['class'=>'form-control','required'])}}
        </div>
    </li>

    <li>
        <div class="nam_val">Short Description </div>
        <div class="input_val">
            {{Form::textarea('short_description',null,['class'=>'form-control','required','rows'=>3])}}
        </div>
    </li>
     <li>
        <div class="nam_val">Description</div>
        <div>
            {{Form::textarea('description',null,['placeholder'=>'Description','id'=>'description', 'class'=>'textarea form-control'])}}
        </div>
    </li>
     

</ul>