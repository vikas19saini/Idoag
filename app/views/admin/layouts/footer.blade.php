<footer class="main-footer">

	<div class="pull-right hidden-xs">
  
  		<b>Version</b> 1.0
	
    </div>

	<strong>Copyright &copy; 2015-2016 <a href="http://igenero.com">iGenero</a>.</strong> All rights reserved.

</footer>


<div class="modal fade" id="adminformConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog thankyou_modal-dialog">
        <div class="modal-content institutions_modal-content">
            <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
            <div class="modal-header">
                <h4 class="modal-title" id="frm_title">Delete</h4>
            </div>
            <div class="modal-body thankyou_body" id="frm_body"></div>
            <div class="modal-footer">
                <button style='margin-left:10px;' type="button" class="btn btn-primary col-sm-2 pull-right adminformConfirm_yes" data-toggle="modal" data-target="#adminformConfirm2">Yes</button>
                <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminformConfirm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog thankyou_modal-dialog">
        <div class="modal-content institutions_modal-content">
            <button type="button" class="close" data-dismiss="modal"> {{ HTML::image('assets/images/popup_close.png', 'Close') }}</button>
            <div class="modal-header">
                <h4 class="modal-title" id="frm_title">Delete</h4>
            </div>
            <div class="modal-body thankyou_body" id="frm_body"></div>
            <div class="modal-footer">
                <a href="#" style='margin-left:10px;' class="btn btn-primary col-sm-2 pull-right" id="adminfrm_submit">Yes</a>
                <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
            </div>
        </div>
    </div>
</div>

<div class="loading-container">
  <span class="loading-icon"></span>
</div>

