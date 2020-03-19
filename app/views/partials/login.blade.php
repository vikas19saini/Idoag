<div class="modal fade" id="popUpWindow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal_hd">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <!-- Body -->
            <div class="modal-body custom-input">
                <form action="">
                    <div class="form-group inner-icon">
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input type="email" class="form-control" placeholder="Username/Mail id" required>
                    </div>
                    <div class="form-group inner-lok">
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" id="myInput" placeholder="Password" required>
                        <i onclick="myFunction()" class="fa fa-eye-slash" aria-hidden="true"></i> 
                    </div>
                    <div class="custom-control custom-checkbox mb-3 mb-1">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                        <label class="custom-control-label rem-chek" for="customCheck">Remember me</label>
                    <div class="forgot-txt">Forgot Password?</div>
                    </div>
                </form>
            </div>

        <!-- Button -->
            <div class="modal-footer custom-btn">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <div class="modal-ftr"><p>Doesn’t have an account? Get subscription</p></div>
        </div>
    </div>
</div>