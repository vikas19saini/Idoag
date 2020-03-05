{{Form::hidden('brand_id',$brand->id)}}

<ul>
    <li>
        <div class="nam_val">Name</div>
        <div class="input_val">
            {{Form::text('name',null,['placeholder'=>'Outlet Name','class' => 'form-control','required'])}}
            {{ errors_for('name', $errors) }}
        </div>
    </li>
    <li>
        <div class="nam_val">Address</div>
        <div class="input_val">
            {{Form::textarea('address',null,['placeholder'=>'Address','id'=>'description', 'class' => 'form-control'])}}
            {{ errors_for('address', $errors) }}
        </div>
    </li>
    <li>
        <div class="nam_val">Locality</div>
        <div class="input_val">
            {{Form::text('locality',null,['class' => 'form-control'])}}
            {{ errors_for('locality', $errors) }}
        </div>
    </li>

        <li>
            <div class="nam_val">State</div>
            <div class="input_val"> {{Form::text('state',null,['placeholder'=>'State','class' => 'form-control','required'])}}
                {{ errors_for('state', $errors) }}

            </div>
        </li>

        <li>
            <div class="nam_val">City</div>
            <div class="input_val">
                {{Form::text('city',null,['placeholder'=>'City','class' => 'form-control','required'])}}
                {{ errors_for('city', $errors) }}
            </div>
        </li>
     <li>
        <div class="nam_val">Contact Detail</div>
        <div class="input_val">
            {{Form::textarea('contact_info',null,['placeholder'=>'Contact details (phone, email, etc.)','id'=>'contact_info', 'class' => 'form-control'])}}
        </div>
    </li>

</ul>