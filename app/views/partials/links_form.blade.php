<input type="hidden" name="text" value="text">

<ul>

    <li>
        <div class="nam_val">Link Title</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder'=>'Link Name','class' => 'form-control'])}}
        </div>
    </li>
    <li>
        <div class="nam_val">Description</div>
        <div class="textarea_val">
            {{Form::textarea('description',null,['placeholder'=>'Description','id'=>'description', 'class'=>'textarea form-control'])}}
        </div>
    </li>
    
</ul>