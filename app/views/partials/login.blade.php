<div class="modal fade" id="popUpWindow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal_hd">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <!-- Body -->
            <div class="modal-body custom-input">
                {{ Form::open(['route' => 'sessions.store', 'id' => 'login-form']) }}
                    <div class="form-group inner-icon">
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                        {{ Form::email('email', null, ['placeholder' => 'Email Address', 'required' => 'required', 'autocomplete' => 'off','class'=>'form-control']) }}
                        {{ errors_for('email', $errors) }}
                        
                    </div>
                    <div class="form-group inner-lok">
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        {{ Form::password('password', ['placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off','class'=>'form-control']) }}
                        {{ errors_for('password', $errors) }}
                        <i onclick="myFunction()" class="fa fa-eye-slash" aria-hidden="true"></i> 
                    </div>
                    <div class="custom-control custom-checkbox mb-3 mb-1">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                        <label class="custom-control-label rem-chek" for="customCheck">Remember me</label>
                    <div class="forgot-txt">Forgot Password?</div>
                    </div>
                
            </div>

        <!-- Button -->
            <div class="modal-footer custom-btn">
            {{ Form::submit('Login', array('class' => 'btn btn-primary btn-block')) }}
              
            </div>
            {{ Form::close() }}
            <div class="modal-ftr"><p>Doesn’t have an account? Get subscription</p></div>
        </div>
    </div>
</div>