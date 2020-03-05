{{ Form::hidden('internship', 'internship') }}
<ul>

    <li>
        <div class="nam_val">Internship Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder' => 'Title', 'class' => 'form-control', 'required' => 'required'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">Skills  </div>
        <div class="input_val">
            {{Form::text('skills',null,['placeholder' => 'Skills', 'class' => 'form-control', 'required' => 'required'])}}
        </div>
    </li>


    <li class="date_txt">
        <div class="row clearfix">
            <div class="col-sm-6 date_clear">
                <div class="nam_val">Internship Start Date</div>
                <div class="input_val tabs">
                    {{Form::text('start_date',null,['id' => 'start_date','required'])}}
                </div>
            </div>
            <div class="col-sm-6 date_clear">
                <div class="nam_val">Internship End Date</div>
                <div class="input_val tabs">
                    {{Form::text('end_date',null,['id' => 'end_date','required'])}}
                </div>
            </div>
        </div>
    </li>
    <li class="date_txt">
        <div class="row clearfix">
            <div class="col-sm-6 date_clear"> <div class="nam_val">Is Image Required?</div>
        <div class="input_val">{{ Form::checkbox('isimage', 1, null, ['class' => 'field', 'id'=>'isimage']) }}</div>
            </div>
            <div class="col-sm-6 date_clear">   <div class="nam_val">Application Close Date</div>
                <div class="input_val tabs">
                    {{Form::text('application_date',null,['id' => 'application_date','required'])}}
                </div>
            </div>
        </div>

    </li>
    <li id="postimage"    @if(!isset($internship))style="display:none" @endif>
        <div class="nam_val">Internship Image</div>
        <div class="input_val">
            {{Form::file('internship_image',['placeholder' => 'Image', 'class' => 'internship_image'])}}
            @if(isset($internship) && $internship->image!='')
                <img class="preview_internship" src="/uploads/photos/{{$internship->image}}"  style="max-height:200px; max-width:200px;"/>
            @else
                <img class="preview_internship"  src="/uploads/photos/internship_default.jpg"  style="max-height:200px; max-width:200px;"/>
            @endif
            <div class="displaysize">Please Upload a Image of Size : 1200 x 677 </div>
        </div>
    </li>

    @if(isset($internship))
        <li>
            <div class="nam_val">Category</div>
            <div class="input_val">{{ Form::select('category', array('' => 'Select Category') + $categories, $internship->category, ['class' => 'form-control', 'id' => 'categoryid', 'required' => 'required'])}}
            </div>
        </li>
        <li>
            <div class="nam_val">City</div>
            <div class="input_val">
                {{Form::text('city',null,['class'=>'form-control'])}}
            </div>
        </li>
    @else
        <li>
            <div class="nam_val">Category</div>
            <div class="input_val">{{ Form::select('category', array('' => 'Select Category') + $categories, 'null', ['class' => 'form-control', 'id' => 'categoryid', 'required' => 'required'])}}
            </div>
        </li>
    <li>
        <div class="nam_val">Locations</div>
        <div class="input_val">
            {{Form::text('city', null, ['class'=>'form-control', 'placeholder' => 'Cities seperate by comma'])}}
        </div>
    </li>
@endif
    <li>
        <div class="nam_val">Internship Type</div>
        <div class="input_val">
            {{Form::select('offer_type',['' => 'Select Internship Type']+$internship_types,null,['class'=>'form-control','required'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">Resume Preferences</div>
        <div class="input_val">
            {{Form::select('resume_preference',['' => 'Select Resume Preference']+$resume_preferences,null,['class'=>'form-control','required'])}}
        </div>
    </li>

    <li>
        <div class="nam_val">Stipend Amount</div>
        <div class="input_val">
            {{Form::text('amount',null,['class'=>'form-control','id' => 'amount'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">No. of Positions</div>
        <div class="input_val">
            {{Form::text('positions',null,['class'=>'form-control','required'])}}   </div>
    </li>
    <li>
        <div class="nam_val"> Short Description</div>
        <div class="input_val">
            {{Form::textarea('short_description',null,['class'=>'form-control','required','rows'=>3])}}
        </div>
    </li>
    <li>
        <div class="nam_val">Description</div>
        <div class="textarea_val">

            {{Form::textarea('description',null,['class'=>'form-control textarea' ,'required','rows'=>'10'])}}
</div>
    </li>
    @for($i=1;$i<=5;$i++)
        <li>
            <div class="nam_val">Question {{$i}}</div>
            <div class="input_val">
                {{Form::text('question'.$i,null,['class'=>'form-control'])}}
            </div>
        </li>
    @endfor
    <li>Note: Leave Questions blank if not required.</li>

</ul>