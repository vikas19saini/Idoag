<input type="hidden" name="instext" value="instext">

<ul>

    <li>
        <div class="nam_val">Link Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder'=>'Link Name','class' => 'form-control'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">Description</div>
        <div>
            {{Form::textarea('description',null,['placeholder'=>'Description','id'=>'description', 'class'=>'textarea form-control'])}}
        </div>
    </li>
    
</ul>